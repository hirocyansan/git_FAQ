from django.contrib import admin
from django.urls import path

from . import views
# from .views import initialStart, page_n, page_n0, branch_html, page0_1, page0_2, page1_1, page1_2, page2_1, page2_2, \
#                                 page3_1, page3_1_1, page3_2, page4_1, page4_2, page5_1, page5_2,  \
#                                 page6_1, page6_2, page7_1, page7_2, page8_1, page8_2,  \
#                                 page9_1, page9_2, page10_1, page10_2, \
#                                 ankenNyuuryokuKan1, mitsumorisyoIraiKan2, \
#                                 mitumorisyoNyuusyuKan3, ringiShoninKan4, \
#                                 keiyakusyoSakuseiKan5, keiyakusyoTeiketsuKan6, \
#                                 cyuumonKan7, nouhinKan8, \
#                                 seikyuusyoNyuusyu9, shiharaiKan10, \
#                                 kanriNoCheck, \
#                                 mitsumoriSave, ringiShoninSave, \
#                                 keiyakusyoSakuseiSave, keiyakusyoTeiketsuSave, \
#                                 cyuumonSave, nouhinSave, \
#                                 seikyuusyoSave, shiharaiSave, \
#                                 kingakuInputAgain,kingakuInputAgain2                                  

urlpatterns = [

#    path('book/', views.PrimeappView.as_view()),
    path('book/n-treat/', views.NumberTreatView.as_view(), name='n-treat'),
    path('book/rtn-top/', views.RtnTopView.as_view(), name='rtn-top'),
    path('book/page_n/', views.page_n, name='page_n'),
    path('book/page_n0/', views.page_n0, name='page_n0'),    
    path('book/page0_1/', views.page0_1, name='page0_1'),
    path('book/page0_2/', views.page0_2, name='page0_2'),
    path('book/page1_1/', views.page1_1, name='page1_1'),
    path('book/page1_2/', views.page1_2, name='page1_2'),
    path('book/page2_1/', views.page2_1, name='page2_1'),
    path('book/page2_2/', views.page2_2, name='page2_2'),
    path('book/page3_1/', views.page3_1, name='page3_1'),  
    path('book/page3_1_1/', views.page3_1_1, name='page3_1_1'),      
    path('book/page3_2/', views.page3_2, name='page3_2'),    
    path('book/page4_1/', views.page4_1, name='page4_1'),    
    path('book/page4_2/', views.page4_2, name='page4_2'),    
    path('book/page5_1/', views.page5_1, name='page5_1'),    
    path('book/page5_2/', views.page5_2, name='page5_2'),    
    path('book/page6_1/', views.page6_1, name='page6_1'),    
    path('book/page6_2/', views.page6_2, name='page6_2'),    
    path('book/page7_1/', views.page7_1, name='page7_1'),    
    path('book/page7_2/', views.page7_2, name='page7_2'),    
    path('book/page8_1/', views.page8_1, name='page8_1'),    
    path('book/page8_2/', views.page8_2, name='page8_2'),    
    path('book/page9_1/', views.page9_1, name='page9_1'),    
    path('book/page9_2/', views.page9_2, name='page9_2'),    
    path('book/page10_1/', views.page10_1, name='page10_1'),    
    path('book/page10_2/', views.page10_2, name='page10_2'),    
#    path('book/', views.branch_html, name='branch_html'),

#    path('book/', views.page_n.as_view(),name='page_n'),
    path('book/', views.initialStart, name='initialStart'),
    path('book/page_n', views.page_n, name='page_n'),
    path('book/', views.page_n0, name='page_n0'),    
    path('book/ankenNyuuryokuKan1', views.ankenNyuuryokuKan1, name='ankenNyuuryokuKan1'),
    path('book/mitsumorisyoIraiKan2', views.mitsumorisyoIraiKan2, name='mitsumorisyoIraiKan2'),
    path('book/mitumorisyoNyuusyuKan3', views.mitumorisyoNyuusyuKan3, name='mitumorisyoNyuusyuKan3'),
    path('book/ringiShoninKan4', views.ringiShoninKan4, name='ringiShoninKan4'),
    path('book/keiyakusyoSakuseiKan5', views.keiyakusyoSakuseiKan5, name='keiyakusyoSakuseiKan5'),
    path('book/keiyakusyoTeiketsuKan6', views.keiyakusyoTeiketsuKan6, name='keiyakusyoTeiketsuKan6'),
    path('book/cyuumonKan7', views.cyuumonKan7, name='cyuumonKan7'),
    path('book/nouhinKan8', views.nouhinKan8, name='nouhinKan8'),
    path('book/seikyuusyoNyuusyu9', views.seikyuusyoNyuusyu9, name='seikyuusyoNyuusyu9'),
    path('book/shiharaiKan10', views.shiharaiKan10, name='shiharaiKan10'),

    path('book/kanriNoCheck', views.kanriNoCheck, name='kanriNoCheck'),
    path('book/mitsumoriSave', views.mitsumoriSave, name='mitsumoriSave'),
    path('book/ringiShoninSave', views.ringiShoninSave, name='ringiShoninSave'),
    path('book/keiyakusyoSakuseiSave', views.keiyakusyoSakuseiSave, name='keiyakusyoSakuseiSave'),
    path('book/keiyakusyoTeiketsuSave', views.keiyakusyoTeiketsuSave, name='keiyakusyoTeiketsuSave'),
    path('book/cyuumonSave', views.cyuumonSave, name='cyuumonSave'),
    path('book/nouhinSave', views.nouhinSave, name='nouhinSave'),
    path('book/seikyuusyoSave', views.seikyuusyoSave, name='seikyuusyoSave'),
    path('book/shiharaiSave', views.shiharaiSave, name='shiharaiSave'),

    path('book/kingakuInputAgain', views.kingakuInputAgain, name='kingakuInputAgain'),
    path('book/kingakuInputAgain2', views.kingakuInputAgain2, name='kingakuInputAgain2'),

]
print("currently, 'urls.py' last line!!")