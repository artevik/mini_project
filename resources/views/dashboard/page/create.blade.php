@extends('frontend.welcome')

@section('content')

    <div class="container">
        <div class="row">
            <!-- Latest Posts -->
            <main class="post blog-post col-lg-12">
                <div class="container">
                    <header>
                        <h3 class="h6">Добавление нового поста</h3>
                    </header>
                    <form action="{{ route('storePost') }}" class="commenting-form" enctype="multipart/form-data" method="post">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="form-group col-md-12">
                                <input type="text" name="title" id="title" placeholder="Название" class="form-control">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="file" name="image" id="image" placeholder="Картинка" class="form-control">
                            </div>
                            <div class="form-group col-md-12">
                                <textarea name="description" id="description" placeholder="Описание" class="form-control"></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-secondary">Добавить</button>
                            </div>
                        </div>
                    </form>
                </div>
            </main>

        </div>
    </div>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>

<script>
        @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}","{{ Session::get('title') }}",{timeOut: 2000, "closeButton": true, "progressBar": true, "positionClass": "toast-top-center",});
            break;

        case 'warning':
            toastr.warning("{{ Session::get('message') }}","{{ Session::get('title') }}",{timeOut: 2000, "closeButton": true, "progressBar": true, "positionClass": "toast-top-center",});
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}","{{ Session::get('title') }}",{timeOut: 2000, "closeButton": true, "progressBar": true, "positionClass": "toast-top-center",});
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}","{{ Session::get('title') }}",{timeOut: 2000, "closeButton": true, "progressBar": true, "positionClass": "toast-top-center",});
            break;
    }
    @endif
</script>
@endpush
