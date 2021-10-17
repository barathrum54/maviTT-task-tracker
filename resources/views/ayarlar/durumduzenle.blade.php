@include('layouts.app')

<script>
    $(function () {
        $("#sortable1").sortable({
            update: function (e, u) {
                var idsInOrder = $("#sortable1").sortable("toArray");
                $.ajax({
                    url: "{{ url('ayarlar/durumKaydet') }}",
                    type: 'post',
                    data: {
                        idsInOrder,
                        _token: '{{csrf_token()}}'
                    },
                    success: function (result) {
                        console.log(idsInOrder);
                    },
                    error: function (result) {
                        alert(JSON.stringify(result));
                    }
                });
            }

        });
    });

</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 mt-4">
            <div class="card">
                <div class="card-header">
                    <div class="row d-flex justify-content-between">
                        <h3> Durum Düzenleme </h3>
                    </div>
                </div>

                <div class="card-body">
                    {{-- <form id="durumForm" name="durumForm" action="/ayarlar/durumKaydet" method="post"> --}}
                    <ul id="sortable1" style="padding-inline-start: 0px;">
                        @foreach ($durumlar as $key => $durum)
                        <li id="{{ $durum->id }}" class="ui-state-default fa-ul"
                            style="margin-left:0px !important; cursor: grab">
                            <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                            {{ $durum->durum_aciklama }}
                            {{ $durum->id }}
                        </li>
                        @endforeach
                    </ul>
                    {{-- <button class="btn btn-primary">Kaydet</button> --}}
                    {{-- @csrf --}}
                    {{-- </form> --}}
                </div>
            </div>
        </div>
    </div>
</div>
