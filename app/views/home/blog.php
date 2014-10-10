<?php 		

	if (file_exists('../vendor/twig/twig/lib/Twig/Autoloader.php')){
		require_once '../vendor/twig/twig/lib/Twig/Autoloader.php';
		Twig_Autoloader::register();

		$templateDir = array('/var/www/proyecto_progra6/app/template');
		$loader = new Twig_Loader_Filesystem($templateDir);
		$twig = new Twig_Environment($loader);

		$template = $twig->loadTemplate('base.html');
		echo $template->render(array('content' => obtenerFormulario($data['blog_id']), 'title' => 'Index'));

	}

	//Generar formulario
	function obtenerFormulario($blog_id) {

		if($blog_id == ''){

		return array("markup" => '<div class="cards">
									  <div class="card">
									    <div class="card-image">
									      <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/mountains.png" alt="">
									    </div>
									    <div class="card-header">
									      First Card
									    </div>
									    <div class="card-copy">
									      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga, officiis sunt neque facilis culpa molestiae necessitatibus delectus veniam provident.</p>
									    </div>
									    <div class="card-stats">
									      <ul>
									        <li>0<span>Coments</span></li>
									      </ul>
									    </div>
									    <a href="/public/home/blog/1" class="leer-mas">Leer mas ></a>
									  </div>

									  <div class="card">
									    <div class="ribbon-wrapper"><div class="ribbon">RIBBON</div></div>
									    <div class="card-image">
									      <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/mountains-4.png" alt="">
									    </div>
									    <div class="card-header">
									      Another Card
									    </div>
									    <div class="card-copy">
									      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga, officiis sunt neque facilis culpa molestiae necessitatibus delectus veniam provident.</p>
									    </div>
									    <div class="card-stats">
									      <ul>
									        <li>0<span>Coments</span></li>
									      </ul>
									    </div>
									    <a href="#" class="leer-mas">Leer mas ></a>
									  </div>

									  <div class="card">
									    <div class="card-image">
									      <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/mountains-3.png" alt="">
									    </div>
									    <div class="card-header">
									      The Last Card
									    </div>
									    <div class="card-copy">
									      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga, officiis sunt neque facilis culpa molestiae necessitatibus delectus veniam provident.</p>
									    </div>
									    <div class="card-stats">
									      <ul>
									        <li>0<span>Coments</span></li>
									      </ul>
									    </div>
									    <a href="#" class="leer-mas">Leer mas ></a>
									  </div>
									</div>');
		}else{
			return array("markup" => '<article class="type-system-serif">
										  <p class="type">Article Type</p>
										  <h1>Article Heading</h1>
										  <h2>These override some of the styles specified in the <code>_variables.scss</code> and <code>_typography.scss</code> partials in <a href="//bitters.bourbon.io">Bitters</a>. You can replace the typography variables and the header font specifications in Bitters with these styles. Then you won&rsquo;t need the wrapping class <code>.type-system-name</code>.</h2>
										  <p class="date">30 Mar 2014</p>
										  <p><span>Lorem ipsum dolor sit amet</span>, consectetur adipisicing elit. Consequatur a, ullam, voluptatum incidunt neque doloremque vel inventore distinctio laudantium harum</a> illo quam nulla dolor alias iure impedit! Accusamus! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, a, ullam, voluptatum incidunt neque porro numquam doloremque vel inventore distinctio laudantium harum illo quam nulla dolor alias iure impedit.
										    <a href="javascript:void(0)" class="read-more">Read More <span>&rsaquo;</span></a>
										  </p>
										  <h3>Subheading lorem</h3>
										  <p><span>Consequatur ullam, voluptatum</span> incidunt neque porro numquam doloremque vel inventore distinctio laudantium harum illo quam nulla dolor alias iure impedit. Accusamus. Consequatur, a, ullam, voluptatum incidunt neque porro numquam doloremque vel inventore distinctio laudantium harum illo quam nulla dolor alias iure impedit! Accusamus.</p>
										  <hr>
										  <p class="author">Author Name</p>
										</article>
										<div class="comment">
										  <div class="comment-image">
										    <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/placeholder_logo_1.png" alt="Logo image">
										  </div>
										  <div class="comment-content">
										    <h1>First Comment Title or Author</h1>
										    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, aspernatur, quia modi minima debitis tempora ducimus quam vero impedit alias earum nemo error tenetur sed.</p>
										    <p class="comment-detail">Date or details about this post</p>
										  </div>
										</div>

										<div class="comment">
										  <div class="comment-image">
										    <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/placeholder_logo_2.png" alt="Logo image">
										  </div>
										  <div class="comment-content">
										    <h1>Another One</h1>
										    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, aspernatur, quia modi minima debitis tempora ducimus quam vero impedit alias earum nemo error tenetur sed.</p>
										    <p class="comment-detail">Date or details about this post</p>
										  </div>
										</div>');
		}
	}
	
?>