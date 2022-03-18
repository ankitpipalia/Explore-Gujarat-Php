from sqlite3 import Cursor
from django.shortcuts import render
import mysql.connector as sql

em = ''
pwd = ''

# Create your views here.


def loginaction(request):
    global em,pwd
    if request.method == "POST":
        m = sql.connect(host="localhost", user="root",passwd="root1234", database='gujarat')
        cursor = m.cursor()
        d = request.POST
        for key, value in d.items():
            if key == "Email":
                em = value
            if key == "Password":
                pwd = value

        c = "select * from users where Email='{}' and Password ='{}'".format(em, pwd)
        cursor.execute(c)
        t = tuple(cursor.fetchall())

        if t == (""):
            return render(request,"error.html")
        return render(request,"index.html")

    return render(request, 'login.html')
