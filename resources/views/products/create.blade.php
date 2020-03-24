@extends('layouts.app', ['activePage' => 'demand-management', 'titlePage' => _('Gerenciador de Pedidos')])

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" autocomplete="off" class="form-horizontal">
          {{-- <form method="post" action="{{ route('category.store') }}" autocomplete="off" class="form-horizontal"> --}}
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Adicionar categoria de produtos') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('product.index') }}" class="btn btn-sm btn-primary">{{ __('Voltar a lista') }}</a>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm 6">

                      <div class="col-sm-12">
                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                          <label for="input-name">Nome</label>
                          <input class="form-control{{ $errors->has('name') ? ' Nome Inválido!' : '' }}" name="name" id="input-name" type="text" required="true" aria-required="true"/>
                          @if ($errors->has('name'))
                            <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                          @endif
                        </div>
                      </div>

                      <div class="col-sm-9">
                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                          <label for="input-name">Categoria</label>
                          <input class="form-control{{ $errors->has('name') ? ' Nome Inválido!' : '' }}" name="name" id="input-name" type="text" required="true" aria-required="true"/>
                          @if ($errors->has('name'))
                            <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                          @endif
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                          <label for="input-value">Valor</label>
                          <input class="form-control{{ $errors->has('name') ? ' Nome Inválido!' : '' }}" name="name" id="input-name" type="text" required="true" aria-required="true"/>
                          @if ($errors->has('name'))
                            <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                          @endif
                        </div>
                      </div>
                  </div>

                  <div class="col-sm 6">
                    <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                      <label for="input-name">Descrição</label>
                      <textarea name="description" id="" cols="30" rows="7" class="form-control{{ $errors->has('description') ? ' Descrição inválida!' : '' }}" id="input-description" required="true" aria-required="true"></textarea>
                      @if ($errors->has('description'))
                        <span id="description-error" class="error text-danger" for="input-description">{{ $errors->first('description') }}</span>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="mdc-select__menu mdc-menu mdc-menu-surface">
                  <ul class="mdc-list">
                    <li class="mdc-list-item" data-value=""></li>
                    <li class="mdc-list-item" data-value="grains">
                      Bread, Cereal, Rice, and Pasta
                    </li>
                    <li class="mdc-list-item mdc-list-item--selected mdc-list-item--disabled" data-value="vegetables">
                      Vegetables
                    </li>
                    <li class="mdc-list-item" data-value="fruit">
                      Fruit
                    </li>
                  </ul>
                </div>

              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Adicionar') }}</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection