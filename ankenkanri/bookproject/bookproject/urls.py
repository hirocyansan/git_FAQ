from django.contrib import admin
from django.urls import path, include
# import book.views   # add

urlpatterns = [
#    path('book/', book.views.index),  #add
    path('admin/', admin.site.urls),
    path('', include('book.urls')),
]
