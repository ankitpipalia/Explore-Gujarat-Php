from sqlite3 import Cursor
from django.shortcuts import render
import mysql.connector as sql
 
fn=''
em=''
pwd=''
g=''

# Create your views here.

def signupaction(request):
    global fn,em,pwd,g
    if request.method=="POST":
        m=sql.connect(host="localhost",user="root",passwd="root1234",database='gujarat')
        cursor=m.cursor()
        d=request.POST
        for key,value in d.items():
            if key=="FName":
                fn=value
            if key=="Email":
                em=value
            if key=='Gender':
                g=value
            if key=="Password":
                pwd=value
            
        c="insert into users Values('{}','{}','{}','{}')".format(fn,em,g,pwd)
        cursor.execute(c)
        m.commit()
    return render(request,'signup.html') 