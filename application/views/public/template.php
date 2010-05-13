<?php defined('SYSPATH') OR die('No direct access allowed.') ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>Projekt zespołowy </title>

    <script type="text/javascript" src="<?php echo url::site('media/js/script.js')?>"></script>

    <link rel="stylesheet" href="<?php echo url::site('media/style.css') ?>" type="text/css" media="screen" />
    <!--[if IE 6]><link rel="stylesheet" href="<?php echo url::site('media/style.ie6.css')?>" type="text/css" media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" href="<?php echo url::site('media/style.ie7.css')?>" type="text/css" media="screen" /><![endif]-->
</head>
<body>
    <div id="art-page-background-gradient"></div>
    <div id="art-main">
        <div class="art-Sheet">
            <div class="art-Sheet-tl"></div>
            <div class="art-Sheet-tr"></div>
            <div class="art-Sheet-bl"></div>
            <div class="art-Sheet-br"></div>
            <div class="art-Sheet-tc"></div>
            <div class="art-Sheet-bc"></div>
            <div class="art-Sheet-cl"></div>
            <div class="art-Sheet-cr"></div>
            <div class="art-Sheet-cc"></div>
            <div class="art-Sheet-body">
                <div class="art-Header">
                    <div class="art-Header-jpeg"></div>
                    <div class="art-Logo">
                        <h1 id="name-text" class="art-Logo-name"><a href="#"></a></h1>
                    </div>
				 <form method="get" id="login" action="javascript:void(0)">
				Login: <input type="text" name="Login" size="15" />
				Hasło: <input type="password" name="Password" size="15" />
				<input class="art-button" type="submit" name="Zaloguj" value="Zaloguj">
				<input class="art-button" type="submit" name="Zarejestruj" value="Zarejestruj">
				</div>
				<div class="art-contentLayout">
                    
					<div class="art-sidebar1">
                        <div class="art-Block">
                            <div class="art-Block-tl"></div>
                            <div class="art-Block-tr"></div>
                            <div class="art-Block-bl"></div>
                            <div class="art-Block-br"></div>
                            <div class="art-Block-tc"></div>
                            <div class="art-Block-bc"></div>
                            <div class="art-Block-cl"></div>
                            <div class="art-Block-cr"></div>
                            <div class="art-Block-cc"></div>
                            <div class="art-Block-body">
                                        <div class="art-BlockHeader">
                                            <div class="l"></div>
                                            <div class="r"></div>
                                           <div class="art-header-tag-icon">
                                                <div class="t">Kategorie</div>
                                            </div>
                                        </div><div class="art-BlockContent">
                                            <div class="art-BlockContent-body">
                                                <div>
												<a href="<?php echo url::site('categories') ?>">Kategorie</a>
												
												
												
													asdasdasd
												
												</div>
                                        		<div class="cleared"></div>
                                            </div>
                                        </div>
                        		<div class="cleared"></div>
                            </div>
                        </div>
                        <div class="art-Block">
                            <div class="art-Block-tl"></div>
                            <div class="art-Block-tr"></div>
                            <div class="art-Block-bl"></div>
                            <div class="art-Block-br"></div>
                            <div class="art-Block-tc"></div>
                            <div class="art-Block-bc"></div>
                            <div class="art-Block-cl"></div>
                            <div class="art-Block-cr"></div>
                            <div class="art-Block-cc"></div>
                            <div class="art-Block-body">
                                        <div class="art-BlockHeader">
                                            <div class="l"></div>
                                            <div class="r"></div>
                                            <div class="art-header-tag-icon">
                                                <div class="t">Koszyk</div>
                                            </div>
                                        </div><div class="art-BlockContent">
                                            <div class="art-BlockContent-body">
                                                <input class="art-button" type="submit" name="Zamów" value="Zamów">
                                        		<div class="cleared"></div>
                                            </div>
                                        </div>
                        		<div class="cleared"></div>
                            </div>
                        </div>
                        <div class="art-Block">
                            <div class="art-Block-tl"></div>
                            <div class="art-Block-tr"></div>
                            <div class="art-Block-bl"></div>
                            <div class="art-Block-br"></div>
                            <div class="art-Block-tc"></div>
                            <div class="art-Block-bc"></div>
                            <div class="art-Block-cl"></div>
                            <div class="art-Block-cr"></div>
                            <div class="art-Block-cc"></div>
                            <div class="art-Block-body">
                                        <div class="art-BlockHeader">
                                            <div class="l"></div>
                                            <div class="r"></div>
                                            <div class="art-header-tag-icon">
                                                <div class="t">Kontakt</div>
                                            </div>
                                        </div>
										<div class="art-BlockContent">
                                            <div class="art-BlockContent-body">
                                               Dział obsługi klienta:<BR />
											   E-mail: <a href="mailto:BOK@hurtex.pl">BOK@hurtex.pl</a>
                                        		<div class="cleared"></div>
                                            </div>
                                        </div>
                        		<div class="cleared"></div>
                            </div>
                        </div>
                    </div>
					<div class="art-content">
					<div class="art-Post">
                        <div class="art-Post-body">
							<div class="art-Post-inner">
                                <h2 class="art-PostHeader">
                                    Welcome
								url::site('{#add-to-cart#}')	
								
                                </h2>
								<div class="art-PostContent">
									<?php	echo $content ?>
								</div>
                        
							</div>
                        </div>
                        
                    </div>
                </div>
					<div class="cleared"></div>
				</div>
				<div class="art-Footer">
					<div class="art-Footer-inner">
						<div class="art-Footer-text">
                            <p><br />
                                Copyright &copy; 2010. All Rights Reserved.</p>
						</div>
					</div>
                <div class="art-Footer-background"></div>
				<div class="cleared"></div>
		</div>
        
            </div>
    </div>
    
</body>
</html>