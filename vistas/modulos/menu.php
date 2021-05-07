<aside class="main-sidebar">

	<section class="sidebar">

		<ul class="sidebar-menu">

			<?php

			if($_SESSION["id_perfil"]==1){
			
			echo '<li class="active">
				
				<a href="inicio">
					
					<i class="fa fa-home"></i>
					<span>Inicio</span>

				</a>

			</li>

			<li >
				
				<a href="usuarios">
					
					<i class="fa fa-user"></i>
					<span>Usuarios</span>

				</a>

			</li>';

		}

		if($_SESSION["id_perfil"] == 1 || $_SESSION["id_perfil"] == 2){

			echo '<li >
				
				<a href="categorias">
					
					<i class="fa fa-th"></i>
					<span>Categorias</span>

				</a>

			</li>

			<li >
				
				<a href="productos">
					
					<i class="fa fa-product-hunt"></i>
					<span>Productos</span>

				</a>

			</li>';

		}

		if($_SESSION["id_perfil"]==3 || $_SESSION["id_perfil"]==1){

		echo	'<li >
				
				<a href="clientes">
					
					<i class="fa fa-users"></i>
					<span>Clientes</span>

				</a>

			</li>';

		}

		if($_SESSION["id_perfil"]==3 || $_SESSION["id_perfil"]==1){

			echo '<li class="treeview">
				
				<a href="#">
					
					<i class="fa fa-list-ul"></i>
					<span>Ventas</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>

				</a>

				<ul class="treeview-menu">
					
					<li>

						<a href="ventas">

							<i class="fa fa-circle-o"></i>
							<span>Administrar Ventas</span>

						</a>

					</li>

					<li>
						
						<a href="crear-venta">
							
							<i class="fa fa-circle-o"></i>
							<span>Nueva Venta</span>								

						</a>

					</li>';

				}

				if($_SESSION["id_perfil"]==1){

				echo '<li>
						
						<a href="reportes">
							
							<i class="fa fa-circle-o"></i>
							<span>Reporte de Ventas</span>								

						</a>

					</li>';
			}


			echo '</ul>

			</li>';		

		?>

		</ul>
		

	</section>
	


</aside>