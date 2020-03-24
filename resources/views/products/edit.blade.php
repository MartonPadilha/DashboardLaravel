@extends('layouts.app', ['activePage' => 'product-management', 'titlePage' => _('Gerenciador de Pedidos')])

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('product.update', ['product' => $product->id]) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('PUT')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Editar produto') }}</h4>
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
                          <input value="{{$product->name}}" class="form-control{{ $errors->has('name') ? ' Nome Inválido!' : '' }}" name="name" id="input-name" type="text" required="true" aria-required="true"/>
                          @if ($errors->has('name'))
                            <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                          @endif
                        </div>
                      </div>
                      
                      
                      <div class="col-sm-12">
                        <div class="form-group{{ $errors->has('value') ? ' has-danger' : '' }}">
                          <label for="input-value">Valor</label>
                          <input value="{{$product->value}}" class="form-control{{ $errors->has('value') ? ' Nome Inválido!' : '' }}" name="value" id="input-value" type="number" required="true" aria-required="true"/>
                          @if ($errors->has('value'))
                          <span id="name-error" class="error text-danger" for="input-value">{{ $errors->first('value') }}</span>
                          @endif
                        </div>
                      </div>
                      
                      <div class="col-sm-12">
                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                          <label for="input-category">Categoria</label>
                          <select name="category" id="input-category" class="form-control">
                            <option value="" selected>{{$product->categories->name}}</option>
                            @foreach ($category as $category)
                              @if ($product->categories->name != $category->name)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                              @endif
                            @endforeach
                          </select>
                        @if ($errors->has('name'))
                        <span id="name-error" class="error text-danger" for="input-category">{{ $errors->first('category') }}</span>
                        @endif
                      </div>
                    </div>
                  </div>
                    
                  <div class="col-sm 6">
                    <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                      <label for="input-description">Descrição</label>
                      <textarea name="description" id="" cols="30" rows="8" class="form-control{{ $errors->has('description') ? ' Descrição inválida!' : '' }}" id="input-description" required="true" aria-required="true">{{$product->description}}</textarea>
                      @if ($errors->has('description'))
                        <span id="description-error" class="error text-danger" for="input-description">{{ $errors->first('description') }}</span>
                      @endif
                    </div>
                  </div>
                </div>

              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Salvar') }}</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection