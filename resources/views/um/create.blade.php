@extends('layouts.app', ['activePage' => 'demand-management', 'titlePage' => _('Gerenciador de Unidade de Medida')])

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form autocomplete="off" class="form-horizontal" name="form_create_category" action="{{ route('um.store') }}" method="POST">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Adicionar uma nova unidade de medida') }}</h4>
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
                      <input class="form-control{{ $errors->has('initials') ? ' Nome Inválido!' : '' }}" name="initials" id="input-initials" type="text" placeholder="{{ __('Sigla') }}" value="{{ old('initials') }}" required="true" aria-required="true"/>
                      @if ($errors->has('initials'))
                        <span id="initials-error" class="error text-danger" for="input-initials">{{ $errors->first('initials') }}</span>
                      @endif
                    </div>
                  </div>
  
                    <div class="col-sm-8">
                      <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('description') ? ' Descrição Inválida!' : '' }}" name="description" id="input-description" type="text" placeholder="{{ __('Descrição') }}" value="{{ old('description') }}" required="true" aria-required="true"/>
                        @if ($errors->has('description'))
                          <span id="description-error" class="error text-danger" for="input-description">{{ $errors->first('description') }}</span>
                        @endif
                      </div>
                    </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Adicionar') }}</button>
              </div>
            </div>
          </form>
          <div class="resultado"></div>
        </div>
      </div>
    </div>
  </div>
@endsection