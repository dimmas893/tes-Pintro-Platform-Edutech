@extends('layouts.BE.template.template')
@section('content')
    <div class="main-content">

        <section class="section">
            <div class="section-header">
                <h1>Halaman One To Many</h1>
            </div>


            <div class="section-body">

                <div class="row my-5">
                    <div class="col-lg-12">
                        <div class="card shadow">
                            <div class="card-header bg-primary">
                                <h3 class="text-light">Tabel One To Many</h3>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    grouping
                                </div>
                                <div class="card-body">
                                    <div id="selectOption">
                                        <select id="select" class="form-control">
                                            <option value="">--- Semua role ---</option>
                                            @foreach ($role as $item => $value)
                                                <option value="{{ $value->id }}">{{ $value->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="card-body" id="TU_all">
                                    <h1 class="text-center text-secondary my-5">Loading...</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            $('#selectOption').on('change', function(e) {
                const cek = 0;
                const select = $('#select').val();
                $("#loading").show();
                e.preventDefault();
                $.ajax({
                    url: '{{ route('user-manytomanyAll') }}',
                    method: 'get',
                    data: {
                        id: select,
                    },
                    success: function(response) {
                        $("#TU_all").html(response);
                        $("table").DataTable({
                            rowReorder: {
                                selector: 'td:nth-child(2)'
                            },
                            destroy: true,
                            responsive: true
                        });

                    }
                });
            });

            TU_all();

            function TU_all() {
                $.ajax({
                    url: '{{ route('user-manytomanyAll') }}',
                    method: 'get',
                    success: function(response) {
                        $("#TU_all").html(response);
                        $("table").DataTable({
                            rowReorder: {
                                selector: 'td:nth-child(2)'
                            },
                            destroy: true,
                            responsive: true
                        });
                    }
                });
            }


        });
    </script>
@endsection
