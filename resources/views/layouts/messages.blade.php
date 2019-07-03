@if(count($errors)>0)
    @foreach($errors->all() as $error)
        <div class="row">
            <div class="col-xs-12">
                <div class="alert alert-danger">
                    {{$error}}
                <div>
            </div>
        </div>
    @endforeach
@endif

@if(session('success'))
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            </div>
        </div>
    </section>
@endif
    
@if(session('error'))
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>
            </div>
        </div>
    </section>
@endif