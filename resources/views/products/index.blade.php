@extends('layouts.app', ['activePage' => 'product-management', 'titlePage' => __('Gerenciamento de Produtos')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">{{ __('Produtos') }}</h4>
              <p class="card-category"> {{ __('Aqui você pode gerenciar seus produtos') }}</p>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-12">
                  @if (session('create'))
                    <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="material-icons">close</i>
                      </button>
                      <span>{{ session('create') }}</span>
                    </div>
                    @endif
                    @if (session('edit'))
                    <div class="alert alert-warning">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="material-icons">close</i>
                      </button>
                      <span>{{ session('edit') }}</span>
                    </div>
                    @endif
                    @if (session('delete'))
                    <div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="material-icons">close</i>
                      </button>
                      <span>{{ session('delete') }}</span>
                    </div>
                    @endif
                  </div>
                </div>
                
              <div class="row">
                <div class="col-12 text-right">
                  <a href="{{ route('product.create') }}" class="btn btn-sm btn-primary">{{ __('Adicionar Produto') }}</a>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table">
                  <thead class=" text-primary">
                    <th>
                        {{ __('Nome') }}
                    </th>
                    <th>
                      {{ __('Descrição') }}
                    </th>
                    <th>
                      {{ __('Categoria') }}
                    </th>
                    <th>
                      {{ __('Tamanho') }}
                    </th>
                    <th>
                      {{ __('Valor') }}
                    </th>
                    <th>
                      {{ __('Custo') }}
                    </th>
                    <th class="text-right">
                      {{ __('Ações') }}
                    </th>
                  </thead>
                  <tbody>
                    @foreach($product as $product)
                      <tr>
                        <td>
                          {{ $product->name }}
                        </td>
                        <td>
                          {{ $product->description }}
                        </td>
                        <td>
                          {{ $product->categories->name }}
                        </td>
                        <td>
                            {{ $product->quantity }} {{ $product->ums->initials}}
                        </td>
                        <td>
                          R$ {{ $product->value }}
                        </td>
                        <td>
                          R$ {{ $product->cost }}
                        </td>
                        
                        <td class="td-actions text-right">
                          <a rel="tooltip" class="btn btn-primary btn-link" href="{{ route('product.edit', ['product' => $product->id]) }}" data-original-title="" title="">
                            <i class="material-icons">edit</i>
                            <div class="ripple-container"></div>
                          </a>

                          <form action="{{ route('product.destroy', ['product' => $product->id]) }}" method="post">
                              @csrf
                              @method('delete')
                                <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("Você tem certeza que deseja deletar este produto?") }}') ? this.parentElement.submit() : ''">
                                    <i class="material-icons">close</i>
                                    <div class="ripple-container"></div>
                                </button>
                            </form>
                        </td>

                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection