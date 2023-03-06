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
                                    <th>Product's Code</th>
                                    <th>Product's Name</th>
                                    <th>Buying Price</th>
                                    <th>Selling Price</th>
                                    <th>Stock</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product as $item)
                                <tr>
                                    <td>{{ $item->prodCode }}</td>
                                    <td>{{ $item->nameProd }}</td>
                                    <td>{{ $item->buyPrice }}</td>
                                    <td>{{ $item->sellPrice }}</td>
                                    <td>{{ $item->stock }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-icon"
                                            data-bs-target="#modalEd{{ $item->id }}" data-bs-toggle="modal"><i
                                                class="mdi mdi-pencil-outline icon-sm"></i></button>
                                        <button type="button" class="btn btn-danger btn-icon"><i
                                                class="mdi mdi-delete icon-sm" data-bs-target="#modalDel{{ $item->id }}"
                                                data-bs-toggle="modal"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $product->links('vendor.pagination.tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal New -->
    <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId"><i class="mdi mdi-table text-warning icon-md"></i> New
                        Products</h5>
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
                                        <video id="video" width="460" height="230" class="mt-2 mb-2"></video>
                                        <input type="text" id="prodCode" name="prodCode" placeholder="Product's Code"
                                            class="form-control text-light" />
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Product's Name</label>
                                        <input type="text" class="form-control text-light" id="nameProd" name="nameProd"
                                            placeholder="Product's Name">
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
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    @foreach ($product as $prd)
    <div class="modal fade" id="modalEd{{ $prd->id }}" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId"><i class="mdi mdi-table-edit text-warning icon-md"></i>
                        Edit Products</h5>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close"><i
                            class="mdi mdi-window-close"></i></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="{{ route('product.update') }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-12 grid-margin">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Product's Code</label>
                                        <input type="text" id="prodCode" name="prodCode" placeholder="Product's Code"
                                            class="form-control text-dark" value="{{ $prd->prodCode }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Product's Name</label>
                                        <input type="text" class="form-control text-light" id="nameProd" name="nameProd"
                                            placeholder="Product's Name" value="{{ $prd->nameProd }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Buying Price</label>
                                        <input type="number" class="form-control text-light" id="buyPrice"
                                            name="buyPrice" placeholder="Buying Price" value="{{ $prd->buyPrice }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputConfirmPassword1">Selling Price</label>
                                        <input type="number" class="form-control text-light" id="sellPrice"
                                            name="sellPrice" placeholder="Selling Price" value="{{ $prd->sellPrice }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputConfirmPassword1">Stock</label>
                                        <input type="number" class="form-control text-light" id="stock" name="stock"
                                            placeholder="Stock" value="{{ $prd->stock }}">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    {{-- Delete Modal --}}
    @foreach ($product as $prd)
    <div class="modal fade" id="modalDel{{ $prd->id }}" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId"><i class="mdi mdi-table-edit text-warning icon-md"></i>
                        Edit Products</h5>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close"><i
                            class="mdi mdi-window-close"></i></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="{{ route('product.delete', $prd->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="row">
                                <div class="col-lg-12 grid-margin">
                                    <h4 class="display-4">Do you want to delete this data?</h4>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-success">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @push('theJS')
    <script>
        var modalId = document.getElementById('modalId');
    
        modalId.addEventListener('show.bs.modal', function (event) {
              let button = event.relatedTarget;
              let recipient = button.getAttribute('data-bs-whatever');
        });
        var modalEd = document.getElementById('modalEd');
    
        modalEd.addEventListener('show.bs.modal', function (event) {
              let button = event.relatedTarget;
              let recipient = button.getAttribute('data-bs-whatever');
        });
        var modalDel = document.getElementById('modalDel');
    
        modalDel.addEventListener('show.bs.modal', function (event) {
              let button = event.relatedTarget;
              let recipient = button.getAttribute('data-bs-whatever');
        });
    </script>
    @if(session()->has('success'))
    <script>
        Swal.fire({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            icon: 'success',
            title: '{{ Session::get('success') }}'
        });
    </script>
    @else
    @if (session()->has('errors'))
    <script>
        Swal.fire({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                icon: 'error',
                title: '{{ Session::get('errors') }}'
            });
    </script>
    @endif
    @endif
    <script>
        var context = new AudioContext();
        var soundBuffer;
        var request = new XMLHttpRequest();
        request.open('GET', "{{ asset('assets/sound/dor.mp3') }}", true);
        request.responseType = 'arraybuffer';
      
        request.onload = function() {
          context.decodeAudioData(request.response, function(buffer) {
            soundBuffer = buffer;
          });
        };
      
        request.send();
      
        function requestCamera() {
          navigator.mediaDevices.getUserMedia({ video: true })
            .then(function(stream) {
              const video = document.querySelector('#video');
              video.srcObject = stream;
              video.play();
            })
            .catch(function(err) {
              console.error('Error:', err);
            });
        }
      
        window.addEventListener('load', function() {
          requestCamera();
      
          Quagga.init({
            inputStream: {
              name: "Live",
              type: "LiveStream",
              target: document.querySelector('#video')
            },
            decoder: {
              readers: ["ean_reader"]
            }
          }, function(err) {
            if (err) {
              console.error('Error:', err);
              return;
            }
            console.log('Quagga initialization succeeded');
            Quagga.start();
          });
      
          Quagga.onDetected(function(result) {
            console.log('Barcode detected and processed : [' + result.codeResult.code + ']', result);
            document.querySelector('#prodCode').value = result.codeResult.code;
            $('#prodCode').trigger('input');
      
            context.resume().then(function() {
              var source = context.createBufferSource();
              source.buffer = soundBuffer;
              source.connect(context.destination);
              source.start();
            });
          });
        });
      
        $(document).ready(function() {
          $('#prodCode').on('input', function() {
            console.log('Barcode Scanner detected');
            var prodCode = $(this).val();
            $.ajax({
              url: '/getProdCode/' + prodCode,
              type: 'GET',
              dataType: 'json',
              success: function(response) {
                if (response.exists) {
                  $('#nameProd').val(response.nameProd);
                  $('#buyPrice').val(response.buyPrice);
                  $('#sellPrice').val(response.sellPrice);
                  $('#stock').val(response.stock);
                } else {
                  $('#nameProd').val('');
                  $('#buyPrice').val('');
                  $('#sellPrice').val('');
                  $('#stock').val('');
                }
              }
            });
          });
        });
    </script>
    @endpush
</x-layout.app>