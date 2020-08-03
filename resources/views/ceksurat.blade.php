@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12 text-center">
			<!-- <h1 class="title"><span style="background: linear-gradient(to right, #8C0606 0%, #FF0000 50%, #8C0606 100%); -webkit-background-clip: text;-webkit-text-fill-color: transparent; font-size: 64px">PROFIL BPAD</span></h1> -->
			<h1 class="title" style="font-family: 'Century Gothic'; font-size: 64px"><span style="color: #006cb8; font-weight: bold">Cek Surat</h1>
		</div>
	</div>
</div>
<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- MAIN -->
            <div class="col-md-2"></div>
			<main id="main" class="col-md-8">
				<!-- article -->
				<div class="article">
					<!-- article content -->
					<div class="article-content row">
						<form class="form-horizontal" method="GET" action="{{ url('portal/ceksurat') }}" data-toggle="validator">
                            @csrf
							<!-- <input class="input" type="email" placeholder="Enter your email"> -->
                            <!-- <label>Masukkan Kode atau Nomor Surat</label> -->

                            <div class="form-group">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <input style="align-content: center;" class=" input text-center" type="text" name="ceksurat" placeholder="Masukkan kode atau nomor surat" autocomplete="off" required>
                                    <button class="m-t-30 b-t-30 primary-button pull-right" type="submit">Submit</button>
                                </div>
                            </div>
                            
                        </form>
					</div>
					<!-- /article content -->

                    @if(isset($query))
                    <!-- article content -->
					<div class="article-content row">
						<table>
                            {!! $treedisp !!}
                        </table>
                        <!-- {{ $idsurat }} -->
                    </div>
                    <!-- /article content -->
                    @endif
				</div>					
			</main>
			<!-- /MAIN -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

@endsection