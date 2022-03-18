from django.shortcuts import render

# Create your views here.

def spotsaction(request):
    return render(request,'spots.html')