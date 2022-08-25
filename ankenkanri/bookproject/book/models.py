from django.db import models

# Create your models here.
class AnkenList(models.Model):

    keiriShonin = models.BooleanField(null=True, default=True)
    statusCode = models.IntegerField(null=True, blank=True)
    status = models.CharField(max_length=30, null=True, blank=True)
    edabanGroup = models.IntegerField(default=0)
    shiharaiPattern = models.IntegerField(null=True, blank=True)
    kanriNo = models.CharField(max_length=30, null=True, blank=True)
    edaban = models.CharField(max_length=30, null=True, blank=True)
    ankenMei = models.CharField(max_length=30, null=True, blank=True)
    torihikisakiCode = models.IntegerField(null=True, blank=True)
    torihikisakiMei = models.CharField(max_length=30, null=True, blank=True)
    kanjokamoku = models.CharField(max_length=30, null=True, blank=True)

    keikakuTanka = models.IntegerField(null=True, blank=True)
    keikakuSuu = models.IntegerField(null=True, blank=True)
    keikakuGokei = models.IntegerField(null=True, blank=True)

    mitsumoriTanka = models.IntegerField(null=True, blank=True)
    mitsumoriSuu = models.IntegerField(null=True, blank=True)
    mitsumoriGokei = models.IntegerField(null=True, blank=True)
    mitsumoriLink = models.URLField(null=True, blank=True)

    ringiTanka = models.IntegerField(null=True, blank=True)  
    ringiSuu = models.IntegerField(null=True, blank=True)  
    ringiGokei = models.IntegerField(null=True, blank=True)  
    ringishoNo = models.CharField(max_length=30, null=True, blank=True)  
    ringishoLink = models.URLField(null=True, blank=True)

    wfNo = models.CharField(max_length=30, null=True, blank=True)
    keiyakuKingaku = models.IntegerField(null=True, blank=True)
    keiyakushoNo = models.CharField(max_length=30, null=True, blank=True) 
    keiyakushoLink = models.URLField(null=True, blank=True)

    onatsuRingiNo =  models.CharField(max_length=30, null=True, blank=True)  
    onatsuRingiLink = models.URLField(null=True, blank=True)       

    chumonTanka = models.IntegerField(null=True, blank=True)
    chumonSuu = models.IntegerField(null=True, blank=True)
    chumonGokei = models.IntegerField(null=True, blank=True)
    chumonLink = models.URLField(null=True, blank=True)

    nohinKigen = models.DateTimeField(null=True, blank=True)
    kenshuKigen = models.DateTimeField(null=True, blank=True)
    shiharaiKigen = models.DateTimeField(null=True, blank=True)

    nohinTanka = models.IntegerField(null=True, blank=True)
    nohinSuu = models.IntegerField(null=True, blank=True)
    nohinGokei = models.IntegerField(null=True, blank=True)
    nohinLink = models.URLField(null=True, blank=True)  

    shiharaiTanka = models.IntegerField(null=True, blank=True)
    konyuSuu = models.IntegerField(null=True, blank=True)
    konyuGokei = models.IntegerField(null=True, blank=True)
    seikyushoLink = models.URLField(null=True, blank=True)

    keikaku_Jisseki = models.IntegerField(null=True, blank=True)

    kurikaeshiKigen = models.DateTimeField(null=True, blank=True)
    konyuKaisha = models.CharField(max_length=30, null=True, blank=True)
    dataKoshinbi = models.DateTimeField(null=True, blank=True)
    saishuKoshinsha = models.CharField(max_length=30, null=True, blank=True)
    shainNo = models.IntegerField(null=True, blank=True)
    tantosha = models.CharField(max_length=30, null=True, blank=True)
    comment = models.CharField(max_length=30, null=True, blank=True)
    class Meta:
        db_table = 'ankenList'

    
