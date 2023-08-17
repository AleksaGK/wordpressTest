jQuery(window).load(function() {

	// Select upgrade link
	var upgradeLink   = jQuery('#toplevel_page_shuttle-setup').find('a[href*="shuttlethemes.com"]');
	var upgradeParent = upgradeLink.closest('li');

	// Highlight upgrade link
	upgradeLink.attr('target', '_blank');
	upgradeParent.addClass('shuttle-sidebar-upgrade-pro');
});
