@extends('layouts.app', ['activePage' => 'um-management', 'titlePage' => _('Gerenciador de Unidades de Medida')])

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('um.update', ['um' => $um->id]) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Editar unidade de medida') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('um.index') }}" class="btn btn-sm btn-primary">{{ __('Voltar a lista') }}</a>
                  </div>
                </div>

            <div class="row">
              <div class="col-sm-4">
                <div class="form-group{{ $errors->has('initials') ? ' has-danger' : '' }}">
                  <input class="form-control{{ $errors->has('initials') ? ' Nome Inválido!' : '' }}" name="initials" id="input-initials" type="text" placeholder="{{ __('Sigla') }}" value="{{$um->initials}}" required="true" aria-required="true"/>
                  @if ($errors->has('initials'))
                    <span id="initials-error" class="error text-danger" for="input-initials">{{ $errors->first('initials') }}</span>
                  @endif
                </div>
              </div>

                <div class="col-sm-8">
                  <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('description') ? ' Descrição Inválida!' : '' }}" name="description" id="input-description" type="text" placeholder="{{ __('Descrição') }}" value="{{$um->description}}" required="true" aria-required="true"/>
                    @if ($errors->has('description'))
                      <span id="description-error" class="error text-danger" for="input-description">{{ $errors->first('description') }}</span>
                    @endif
                  </div>
                </div>
          <div class="card-footer ml-auto mr-auto">
            <button type="submit" class="btn btn-primary">{{ __('Salvar') }}</button>
          </div>
        </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection