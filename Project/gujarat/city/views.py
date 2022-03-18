from django.shortcuts import render

# Create your views here.

def cityaction(request):
    return render(request,'city.html')