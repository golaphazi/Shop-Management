<?php
$menu = $this->shop->main_menu('Main');
//print_r($menu);
if(is_array($menu) AND sizeof($menu) > 0){
	foreach($menu AS $setMenu):
	//print_r($setMenu);
	?>
		 <li class="<?=($this->router->method=== $setMenu['MENU_URL'])?"active":"active"?>"> 
			<a href="<?php echo base_url();?><?= $setMenu['MENU_URL'];?>/"> <strong> <?=  $setMenu['ICON_MENU'];?> <span><?=  $setMenu['MENU_NAME'];?></span></strong></a>
			<?php
				$subMenu = $this->shop->main_menu('Sub', $setMenu['MENU_ID']);
				//print_r($subMenu);
				if(is_array($subMenu) AND sizeof($subMenu) > 0){
				
				?>
					<ul class="sub-menu-ul" role="menu" style="">
						<?php
							foreach($subMenu AS $setSubMenu){
							?>
								<li><a href="<?php echo base_url();?><?= $setMenu['MENU_URL'];?>/<?=  $setSubMenu['SUB_MENU_URL'];?>/"><?=  $setSubMenu['SUB_MENU_NAME'];?></a></li>
								
							<?php		
							}
						?>
					</ul>
				<?php						
				}
			?>
		</li> 
	<?php
	endforeach;
}
?>

