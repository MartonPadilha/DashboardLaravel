@extends('layouts.app', ['activePage' => 'category-management', 'titlePage' => _('Gerenciador de Pedidos')])

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('category.update', ['category' => $category->id]) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Adicionar categoria de produtos') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('category.index') }}" class="btn btn-sm btn-primary">{{ __('Voltar a lista') }}</a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                      <label for="input-name">Nome</label>
                      <input class="form-control{{ $errors->has('name') ? ' Nome Inválido!' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Nome') }}" value="{{$category->name}}" required="true" aria-required="true"/>
                      @if ($errors->has('name'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                      @endif
                    </div>
                  </div>
                </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                        <label for="input-description">Descrição</label>
                        <textarea name="description" id="" cols="90" rows="10" class="form-control{{ $errors->has('description') ? ' Descrição inválida!' : '' }}" id="input-description" placeholder="{{ __('Descrição') }}" required="true" aria-required="true">{{$category->description}}</textarea>
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