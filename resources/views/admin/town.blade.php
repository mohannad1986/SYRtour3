@extends('layouts.master')
@section('css')
@toastr_css
@section('title')
{{ trans('town.town') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('town.town') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">Page Title</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
               {{-- ******************************************* --}}
               {{-- <div class="col-xl-12 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body"> --}}


                        <a href="" class="btn btn-success btn-sm" role="button"
                           aria-pressed="true" data-toggle="modal" data-target="#exampleModal">  {{ trans('town.add new town') }}</a><br><br>

                        <div class="table-responsive">
                            <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                   data-page-length="50"
                                   style="text-align: center">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th> {{ trans('town.town name') }}</th>
                                    <th>{{ trans('town.mother city') }} </th>
                                    <th>{{ trans('town.Action') }} </th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1;?>
                                @foreach($towns as $town)
                                    <tr>
                                    <td>{{$i++;}}</td>
                                    <td>{{$town->name}}</td>
                                    <td>{{$town->city->name}}</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" role="button" aria-pressed="true" data-toggle="modal" data-target="#exampleModal6" data-id="{{$town->id}}"  data-name_ar="{{$town->getTranslation('name', 'ar')}}" data-name_en="{{$town->getTranslation('name', 'en')}}"><i class="fa fa-edit"></i></a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"data-target="#exampleModal5" data-id="{{$town->id}}" title="حذف"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>

                                @endforeach


                            </table>
                            {{-- +++ مدالا الاضاقة++ --}}
                            <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
          {{-- _______ --}}
          <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;"
                    class="modal-title">
                    {{ trans('town.add town') }}

                </h5>
                <button type="button" class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                <span
                    aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form
                    action="{{route('town.store')}}"
                    method="post">
                    @csrf

                    <div class="col">
                        <div class="form-group">
                            <label for="Grade_id">{{trans('town.mother city')}} : <span class="text-danger">*</span></label>
                            <select class="custom-select mr-sm-2" name="city_id">
                                <option >{{trans('town.mother city')}}...</option>
                                @foreach( $cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                     <label> {{trans('town.inter town name in Arabic')}}</label>
                    <input id="id" type="text"
                           name="name_ar"
                           class="form-control"
                           value="">
                           <label> {{trans('town.inter town name in English')}} </label>
                           <input id="id" type="text"
                                  name="name_en"
                                  class="form-control"
                                  value="">
                    <div class="modal-footer">
                        <button type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal">{{ trans('town.Close') }}</button>
                        <button type="submit"
                                class="btn btn-danger">{{ trans('town.add town') }}</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- _________ --}}


    </div>
  </div>
</div>

{{-- +++ مدولا التعديل +++++++++++++++ --}}

<div class="modal fade" id="exampleModal6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        {{-- _______ --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;"
                    class="modal-title"
                    id="">
                    {{ trans('town.edit Town') }}

                </h5>
                <button type="button" class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                <span
                    aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form
                    action="{{route('town.update',['5'])}}"
                    method="POST">
                    {{ method_field('patch') }}

                    @csrf
                    <input id="id" type="hidden"
                           name="id"
                           class="form-control"
                           value="">
                    <label>{{trans('town.inter town name in Arabic')}} </label>
                    <input id="name_ar" type="text"
                           name="name_ar"
                           class="form-control"
                           value="">
                           <label>{{trans('town.inter town name in English')}} </label>
                           <input id="name_en" type="text"
                                  name="name_en"
                                  class="form-control"
                                  value="">
                        <div class="col">
                        <div class="form-group">
                            <label for="Grade_id">{{trans('town.mother city')}} <span class="text-danger">*</span></label>
                            <select class="custom-select mr-sm-2" name="city_id">
                                <option value="0">{{trans('town.mother city')}}...</option>
                                @foreach( $cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal">{{ trans('town.Close') }}</button>
                        <button type="submit"
                                class="btn btn-danger">{{ trans('town.edit Town') }}</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- _________ --}}

    </div>


</div>



{{-- ++++++++++++++نهاية مدلا التعديل +++++ --}}

{{-- ============ بداية مودل الحذف للمنتج ======== --}}
<div class="modal fade" id="exampleModal5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        {{-- _______ --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;"
                    class="modal-title"
                    id="">
                    {{trans('town.delet town')}}
                </h5>
                <button type="button" class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                <span
                    aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form
                    action="{{route('town.destroy',['delete'])}}"
                    method="post">
                    {{ method_field('Delete') }}
                    @csrf
                    {{trans('town.Are you sure?')}}
                    <input id="id" type="hidden"
                           name="id"
                           class="form-control"
                           value="">
                    <div class="modal-footer">
                        <button type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal">{{ trans('town.Close') }}</button>
                        <button type="submit"
                                class="btn btn-danger">{{ trans('town.delet town') }}</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- _________ --}}

    </div>


</div>

  {{-- ===================نهاية مودل الحذف للمنتج ========= --}}



@endsection
@section('js')


<script>
    // سكربت الحذف

  $('#exampleModal5').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('id')

    var modal = $(this)
    modal.find('.modal-body  #id').val(id)

  })
  </script>

<script>

    // --سكربت المودل الثالث للخاص بتعديل المنتج --------------
$('#exampleModal6').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('id')
    var name_ar = button.data('name_ar')
    var name_en = button.data('name_en')

    var modal = $(this)
    modal.find('.modal-body  #id').val(id)
    modal.find('.modal-body  #name_ar').val(name_ar)
    modal.find('.modal-body  #name_en').val(name_en)


  })
</script>
@toastr_js
@toastr_render

@endsection
