import urllib.request
import json
import requests
import time
import random
import pymysql
"""
    nic 新闻ID  auto
    cid 分类ID  				['docid']
    title 标题  				['title']
    author 作者 				['source']
    source 来源				['source']
    keywords 关键字			['source'][2:]
    description 描述			['url']
    orderby 排序				50
    content 内容				['digest']
    hits 点击量 访问量		['commentCount']
    addate 发布时间			['ptime']
    
    
    娱乐类60条新闻:
    https://3g.163.com/touch/reconstruct/article/list/BA10TA81wangning/1-20.html
    https://3g.163.com/touch/reconstruct/article/list/BA10TA81wangning/21-20.html
    https://3g.163.com/touch/reconstruct/article/list/BA10TA81wangning/42-20.html


    财经类新闻40条：BA8EE5GMwangning
    https://3g.163.com/touch/reconstruct/article/list/BA8EE5GMwangning/1-20.html
    https://3g.163.com/touch/reconstruct/article/list/BA8EE5GMwangning/21-20.html

    体育类新闻40条：BA8E6OEOwangning
    https://3g.163.com/touch/reconstruct/article/list/BA8E6OEOwangning/1-20.html
    https://3g.163.com/touch/reconstruct/article/list/BA8E6OEOwangning/21-20.html
"""
conn = pymysql.connect(
    host = 'localhost',
    port = 3306,
    db = 'student_project',
    user = 'root',
    passwd = '123456',
    charset = 'utf8'
)

headers_list = [
    # Opera
    {"User-Agent": "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36 OPR/26.0.1656.60"},
    {"User-Agent": "Opera/8.0 (Windows NT 5.1; U; en)"},
    {"User-Agent": "Mozilla/5.0 (Windows NT 5.1; U; en; rv:1.8.1) Gecko/20061208 Firefox/2.0.0 Opera 9.50"},
    # chrome
    {"User-Agent": "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36"},
    # maxthon浏览器
    {"User-Agent": "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Maxthon/4.4.3.4000 Chrome/30.0.1599.101 Safari/537.36"},
    # UC浏览器
    {"User-Agent": "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 UBrowser/4.0.3214.0 Safari/537.36"},
]
# 这里的随机user-agent停用，改用Faker一个随机生成user-agent的库，但是faker太老了，不适用于知乎
headrs_other = random.choice(headers_list)

url_list = [
    "https://3g.163.com/touch/reconstruct/article/list/BA10TA81wangning/1-20.html",
    "https://3g.163.com/touch/reconstruct/article/list/BA10TA81wangning/21-20.html",
    "https://3g.163.com/touch/reconstruct/article/list/BA10TA81wangning/42-20.html",
    "https://3g.163.com/touch/reconstruct/article/list/BA8EE5GMwangning/1-20.html",
    "https://3g.163.com/touch/reconstruct/article/list/BA8EE5GMwangning/21-20.html",
    "https://3g.163.com/touch/reconstruct/article/list/BA8E6OEOwangning/1-20.html",
    "https://3g.163.com/touch/reconstruct/article/list/BA8E6OEOwangning/21-20.html"
]

def get_proxy():
    items = {}
    response = requests.get("http://127.0.0.1:8000/?types=0&count=1&protocol=0").text
    protocol_list = json.loads(response)
    for i in protocol_list:
        items["ip"] = i[0]
        items["port"] = i[1]
    proxy = "http://" + str(items["ip"]) + ":" + str(items["port"])
    return proxy

def requests_url(url):
    s = requests.session()
    s.keep_alive = False
    proxies = {"http://": str(get_proxy())}
    time.sleep(random.randint(1, 2))
    requests.packages.urllib3.disable_warnings()
    html_proto = requests.get(url, headers= headrs_other, verify=False, proxies=proxies, timeout=3)
    html_proto.encoding = 'utf-8'
    html = html_proto.text
    return html

def mysql_insert(items):

    sql = """INSERT INTO news(cid, title, author, source, keywords, description, orderby, content, hits, addate)
          VALUE ('%s', '%s', '%s', '%s', '%s', '%s', '%d', '%s', '%d', '%s')"""%(items['cid'], items['title'], items['author'], items['source'], items['keywords'], items['description'], items['orderby'], items['content'], items['hits'], items['addate'])
    cursor.execute(sql)
    conn.commit()
    return True

num = 0
if __name__ == "__main__":
    conn = conn
    cursor = conn.cursor()
    for i in url_list:
        raw_data = requests_url(i)
        data = json.loads(raw_data[9:-1])       # 去除 "artiList(" 和最后的 ")"
        for i in data:
            keyword = i
        for i in data[keyword]:
            items = {}
            items['cid'] = i['docid']
            items['title'] = i['title']
            items['author'] = i['source']
            items['source'] = i['source']
            items['keywords'] = str(keyword)
            items['description'] = str(i['url'])
            items['orderby'] = 50
            items['content'] = i['digest']
            items['hits'] = int(i['commentCount'])
            items['addate'] = str(i['ptime'])
            if(mysql_insert(items)):
                num += 1
                print("插入成功, 目前成功插入:{0}".format(num))
            else:
                print("插入失败，请检查")
    cursor.close()
    conn.close()
