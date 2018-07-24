<?php
$menu = $this->shop->main_menu('Main');
//print_r($menu);
if(is_array($menu) AND sizeof($menu) > 0){
	foreach($menu AS $setMenu):
	//print_r($setMenu);
	?>
		 <li class="dropdown user user-menu" title="<?=  $setMenu['MENU_NAME'];?>"> 
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" > <?=  $setMenu['ICON_MENU'];?> <span class="hidden-xs"><?=  $setMenu['MENU_NAME'];?></span></a>
			<?php
				$subMenu = $this->shop->main_menu('Sub', $setMenu['MENU_ID']);
				//print_r($subMenu);
				if(is_array($subMenu) AND sizeof($subMenu) > 0){
				
				?>
					<ul class="dropdown-menu custom-super-hearer-ul" role="menu">
						<?php
							foreach($subMenu AS $setSubMenu){
							?>
								<li><a href="<?php echo base_url();?><?= $setMenu['MENU_URL'];?>/<?=  $setSubMenu['SUB_MENU_URL'];?>/"><?=  $setSubMenu['SUB_MENU_NAME'];?></a></li>
								<li class="divider"></li>
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

