<form id="modal-create" class="modal fade" method="post" autocomplete="off">
	@csrf

	<div class="modal-dialog" style="min-width: 80%">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah Jenis Barang</h4>
				<button type="button" class="close" data-dismiss="modal">
					<span>x</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col">
		
						
						<div class="form-group">
							<label class="font-weight-bold">Nama Barang <span class="text-danger">*</span></label>
							<input type="text" name="name" class="form-control" required>
						</div>

						<div class="form-group">
							<label class="font-weight-bold">Jenis Barang <span class="text-danger">*</span></label>
							<select class="form-control" id="jenisbarang" name="jenis_id">
								@foreach ($jenis as $item)
									<option value="{{$item->id}}">{{$item->name}}</option>
								@endforeach
							  </select>
						</div>

						<div class="form-group">
							<label class="font-weight-bold">Stok <span class="text-danger">*</span></label>
							<input type="number" name="stok" class="form-control" required>
						</div>
						
					</div>
				</div>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="submit" class="btn btn-primary">Simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
			</div>
		</div>
	</div>
</form>

@push('js')
<script type="text/javascript">
	function edit(id) {
		let url_target = `{{ url('admin/jenis') }}/${id}`;
		$.getJSON(url_target, function(data) {
			$("#modal-edit").find("input").val(function(index, value) {
				return ['_method', '_token'].includes(this.name) ? value : (data[this.name]);
			});
			$("#modal-edit").attr('action', url_target);
			$("#modal-edit").modal();
		});
	}
</script>
@endpush