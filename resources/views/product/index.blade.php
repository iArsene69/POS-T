<x-layout.app>
    <div class="row">
        <div class="col-lg-12 strech-card grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10">
                            <h4 class="card-title"><i class="mdi mdi-store-24-hour text-danger icon-md"></i> Product
                            </h4>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                data-bs-target="#modalId"><i class="mdi mdi-plus"></i> New</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Check</th>
                                    <th>Product's Name</th>
                                    <th>Product's Code</th>
                                    <th>Buying Price</th>
                                    <th>Selling Price</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product as $item)
                                <tr>
                                    <td></td>
                                    <td>{{ $item->prodCode }}</td>
                                    <td>{{ $item->nameProd }}</td>
                                    <td>{{ $item->buyPrice }}</td>
                                    <td>{{ $item->sellPrice }}</td>
                                    <td>{{ $item->stock }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">New Products</h5>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close"><i
                            class="mdi mdi-window-close"></i></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="{{ route('product.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 grid-margin">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Product's Code</label>
                                        <input type="text" class="form-control text-light" id="prodCode" name="prodCode"
                                            value="{{ $prodCode }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Product's Name</label>
                                        <input type="text" class="form-control text-light" id="nameProd"
                                            name="nameProd" placeholder="Product's Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Buying Price</label>
                                        <input type="number" class="form-control text-light" id="buyPrice"
                                            name="buyPrice" placeholder="Buying Price">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputConfirmPassword1">Selling Price</label>
                                        <input type="number" class="form-control text-light" id="sellPrice"
                                            name="sellPrice" placeholder="Selling Price">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputConfirmPassword1">Stock</label>
                                        <input type="number" class="form-control text-light" id="stock" name="stock"
                                            placeholder="Stock">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('theJS')
    <script>
        var modalId = document.getElementById('modalId');
    
        modalId.addEventListener('show.bs.modal', function (event) {
              // Button that triggered the modal
              let button = event.relatedTarget;
              // Extract info from data-bs-* attributes
              let recipient = button.getAttribute('data-bs-whatever');
    
            // Use above variables to manipulate the DOM
        });
    </script>
    @endpush
</x-layout.app>