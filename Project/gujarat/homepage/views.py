from django.shortcuts import render

# Create your views here.

def homepageaction(request):
    return render(request,'index.html')