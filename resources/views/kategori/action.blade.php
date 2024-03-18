<a href="{{ url('/kategori/' . $id . '/edit') }}" class="btn btn-sm btn-info">Edit</a>
<form action="{{ url('/kategori/' . $id . '/delete') }}" method="POST" style="display: inline;">
    @csrf
    @method('delete')
    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
</form>
