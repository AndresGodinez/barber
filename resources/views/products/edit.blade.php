@extends('layouts.app')
@include('partials.errors')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('products.update', ['product' => $product->id ]) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-row col-md-12">
                        <div class="form-group col-md-6">
                            <label for="name">Nombre</label>
                            <input type="text"
                                   name="name"
                                   id="name"
                                   class="form-control"
                                   placeholder="Nombre"
                                   value="{{$product->name}}"
                                   required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="code">Código Interno</label>
                            <input type="text"
                                   name="code"
                                   id="code"
                                   class="form-control"
                                   placeholder="Código"
                                   value="{{$product->code}}"
                                   required>
                        </div>
                    </div>

                    <div class="form-row col-md-12">
                        <div class="form-group col-md-6">
                            <label for="cost">Costo</label>
                            <input type="text"
                                   name="cost"
                                   id="cost"
                                   class="form-control"
                                   placeholder="$0.00"
                                   value="{{$product->cost}}"
                                   required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="sale_price">Precio Venta</label>
                            <input type="text"
                                   name="sale_price"
                                   id="sale_price"
                                   class="form-control"
                                   placeholder="$0.00"
                                   value="{{$product->sale_price}}"
                                   required>
                        </div>
                    </div>

                    <div class="form-row col-md-12">
                        <div class="form-group col-md-6">
                            <label for="category_id">Categoria</label>
                            <select name="category_id"
                                    id="category_id"
                                    class="form-control"
                                    required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                            {{ $category->id == $product->category_id ? 'selected' : '' }}
                                    >
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="category_id">Proveedor</label>
                            <select name="category_id"
                                    id="category_id"
                                    class="form-control"
                                    required>

                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}"
                                            {{ $supplier->id == $product->supplier_id ? 'selected' : ''}}
                                    >
                                        {{ $supplier->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row col-md-12 mt-1">
                        <div class="form-group form-check pl-4 pt-4 col-md-6">
                            <input type="checkbox"
                                   name="can_be_partial"
                                   id="can_be_partial"
                                   class="form-check-input"
                                    {{ !!$product->can_be_partial ? 'checked' : '' }}

                            >
                            <label for="can_be_partial" class="form-check-label">
                                Puede ser parcial?
                            </label>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="measure">Presentación</label>
                            <input type="text" name="measure" id="measure" value="{{$product->measure}}" class="form-control">
                        </div>
                    </div>

                    <div class="form-row col-md-12">
                        <div class="form-group col-md-6 form-check pl-4 pt-4">
                            <input type="checkbox"
                                   name="it_is_bought_by_box"
                                   id="it_is_bought_by_box"
                                   class="form-check-input"
                                   {{ !!$product->it_is_bought_by_box ? 'checked' : '' }}
                            >
                            <label for="it_is_bought_by_box" class="form-check-label">
                                ¿Solo puede ser comprado por caja?
                            </label>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="products_per_box">Cantidad de productos por caja</label>
                            <input type="text"
                                   name="products_per_box"
                                   id="products_per_box"
                                   value="{{$product->pieces_per_box}}"
                                   class="form-control">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-info text-white">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
@endsection