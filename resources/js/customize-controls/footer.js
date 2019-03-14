
wp.customize.control( 'powered_by', control => {

	control.setting.bind( value => {
		let footerCredit = wp.customize.control( 'footer_credit' );

		value ? footerCredit.deactivate() : footerCredit.activate();
	} );
} );
