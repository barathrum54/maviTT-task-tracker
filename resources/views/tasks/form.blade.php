<div class="form-group">
    <label for="BASLIK">Görev Başlığı</label>
    <input type="text" name="BASLIK" class="form-control" id="BASLIK" autocomplete="off"
        placeholder="Görev Açıklaması Giriniz.">
    <small id="gorevSmall" class="form-text text-muted">Görev Başlığınızı giriniz.</small>
    @error('BASLIK')
    <small style="color:red !important" id="gorevSmall" class="form-text text-muted"> Lütfen başlık giriniz.</small>
    @enderror
</div>
<div class="form-group">
    <label for="ACIKLAMA">Görev Açıklama</label>
    <textarea type="text" name="ACIKLAMA" class="form-control" id="ACIKLAMA" autocomplete="off"
        placeholder="Görev Açıklaması Giriniz."></textarea>
    <small id="gorevSmall" class="form-text text-muted">Görev ile ilgili kısa açıklama giriniz.</small>
    @error('ACIKLAMA')
    <small style="color:red !important" id="gorevSmall" class="form-text text-muted"> Lütfen açıklama giriniz.</small>
    @enderror
</div>

<div class="form-group">
    <label for="NOTLAR">Notlar</label>
    <input type="text" name="NOTLAR" class="form-control" id="NOTLAR" autocomplete="off"
        placeholder="Görev Notlarını Giriniz.">
    <small id="gorevSmall" class="form-text text-muted">Görev ile ilgili notlarınızı giriniz.</small>

</div>

<label for="exampleFormControlSelect1">Görev Kategorisi</label>
<select class="form-control" name="KATEGORI_ID" id="exampleFormControlSelect1">
    @foreach ($kategoriler as $kategori)


    <option value={{ $kategori->id }}>{{ $kategori->baslik }}</option>
    @endforeach

</select>
<label for="exampleFormControlSelect1">Atanacak Kişi</label>
<select class="form-control" name="ATANAN_ID" id="exampleFormControlSelect1">
    @foreach ($users as $user)

    <option value={{ $user->id }}>{{ $user->name }}</option>
    @endforeach
</select>
<script>
    $(document).ready(function () {
        $("#bitisSuresiWrap").hide();
        $("#bitisSuresiBox").click(function () {
            if ($("#bitisSuresiBox").prop("checked")) {
                $("#bitisSuresiWrap").show();
            } else {
                $("#bitisSuresiWrap").hide();
            }
        });
    });

</script>
<br>
<input type="checkbox" id="bitisSuresiBox" name="bitisSuresiBox">
<label for="bitisSuresiBox"> Bitiş Süresi Olsun</label><br>
<div id="bitisSuresiWrap" name="bitisSuresiWrap">

    <label for="hedefSure">Bitiş Süresi :</label>
    <input type="datetime-local" id="hedefSure" name="hedefSure">
</div>

@csrf
