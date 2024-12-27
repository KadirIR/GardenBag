<script>
function miktarArtir(urunFiyati) {
    var miktarInput = document.getElementById('miktar');
    var miktar = parseInt(miktarInput.value);
    miktarInput.value = miktar + 1;
    fiyatGuncelle(miktar + 1, urunFiyati);
}

function miktarAzalt(urunFiyati) {
    var miktarInput = document.getElementById('miktar');
    var miktar = parseInt(miktarInput.value);
    if (miktar > 1) {
        miktarInput.value = miktar - 1;
        fiyatGuncelle(miktar - 1, urunFiyati);
    }
}

function fiyatGuncelle(miktar, urunFiyati) {
    var fiyat = document.getElementById('fiyat');
    var siparisTutari = document.getElementById('siparis-tutari');
    var toplamFiyat = urunFiyati * miktar;
    fiyat.textContent = toplamFiyat.toFixed(2) + '₺';
    siparisTutari.textContent = toplamFiyat.toFixed(2) + '₺';
}
</script>