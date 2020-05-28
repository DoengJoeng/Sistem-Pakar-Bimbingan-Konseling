@extends('layouts.master')

@section('bimbinganCreate')

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data Bimbingan</h3>
        </div>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('bimbingan.create')}}" class="nav-link">Tambah Data</a>
          </li>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 1%"> NO </th>
                      <th style="width: 5%"> Kode Bimbingan </th>
                      <th style="width: 10%"> Nama Lengkap </th>
                      <th style="width: 5%"> NIM </th>
                      <th style="width: 5%"> Jenis Kelamin </th>
                      <th style="width: 10%"> Aksi </th>
                  </tr>
              </thead>
              <tbody>
                @foreach($bimbingan as $b)
                  <tr>
                      <td> {{ $loop->iteration }} </td>
                      <td> {{ $b->kodeBimbingan }} </td>
                      <td> {{ $b->namaLengkap }} </td>
                      <td> {{ $b->nim }}</td>
                      <td> {{ $b->jenisKelamin }}</td>
                      <td class="project-actions text-right">
                          <a class="btn btn-primary btn-sm" href="{{route('bimbingan.show', $b->id)}}">
                              <i class="fas fa-folder">
                              </i>
                              View
                          </a>
                          <a class="btn btn-info btn-sm" href="{{route('bimbingan.edit', $b->id)}}">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Edit
                          </a>
                          <a class="btn btn-danger btn-sm" href="#">
                              <i class="fas fa-trash">
                              </i>
                              Delete
                          </a>
                      </td>
                  </tr>
                @endforeach
              </tbody>
          </table>
        </div>
               {{-- Pagination --}}
          <div class="pagination " style="margin:20px 0">
            {{$bimbingan->links()}}
          </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>

@endsection