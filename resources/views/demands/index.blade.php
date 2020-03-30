@extends('layouts.app', ['activePage' => 'demand-management', 'titlePage' => __('Gerenciamento de Pedidos')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Pedidos') }}</h4>
                <p class="card-category"> {{ __('Aqui você pode gerenciar seus pedidos') }}</p>
              </div>
              <div class="card-body">
                @if (session('status'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row">
                  <div class="col-12 text-right">
                    <a href="{{ route('demand.create') }}" class="btn btn-sm btn-primary">{{ __('Adicionar Pedido') }}</a>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                        {{ __('Usuário') }}
                     </th>
                      <th>
                        {{ __('Cliente') }}
                      </th>
                      <th>
                        {{ __('Produtos') }}
                      </th>
                      <th>
                        {{ __('Valor') }}
                      </th>
                      <th>
                        {{ __('Pedido às') }}
                      </th>
                      <th>
                        {{ __('Para às') }}
                      </th>
                      <th>
                        {{ __('Data') }}
                      </th>
                      <th>
                        {{ __('Status') }}
                      </th>
                      <th class="text-right">
                        {{ __('Ações') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($demands as $demand)
                        <tr>
                          <td>
                            {{ $demand->users->name }}
                          </td>
                          <td>
                            {{ $demand->clients->name }}
                          </td>
                          <td>
                              @foreach ($demand->products as $product)
                                  {{$product->name}}<br>
                              @endforeach
                          </td>
                          <td>
                            R$ {{ $demand->value }}
                          </td>
                          <td>
                            {{ date('H:i', strtotime($demand->created_at))}}
                          </td>
                          <td>
                            {{ $demand->time_take }}
                          </td>
                          <td>
                            {{ date('d-m-Y', strtotime($demand->date))}}
                          </td>
                          <td>
                            {{ $demand->status }}
                          </td>
                          <td class="td-actions text-right">
                            @if ($demand->status == 'Aguardando')
                            <form action="{{ route('demand.update', ['demand' => $demand->id]) }}" method="post">
                                @csrf
                                @method('put')
                              <button type="button" class="btn btn-success btn-link" data-original-title="" title="" onclick="confirm('{{ __("Este pedido foi entregue?") }}') ? this.parentElement.submit() : ''">
                                <i class="material-icons">done</i>
                                <div class="ripple-container"></div>
                              </button>
                           </form>                               
                            @endif

                            <a rel="tooltip" class="btn btn-primary btn-link" href="{{ route('demand.edit', ['demand' => $demand->id]) }}" data-original-title="" title="">
                              <i class="material-icons">edit</i>
                              <div class="ripple-container"></div>
                            </a>

                            <form action="{{ route('demand.destroy', ['demand' => $demand->id]) }}" method="post">
                                @csrf
                                @method('delete')
                                  <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("Você tem certeza que deseja deletar este pedido?") }}') ? this.parentElement.submit() : ''">
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