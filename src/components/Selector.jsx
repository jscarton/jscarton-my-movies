import React from 'react'

export const Selector = React.forwardRef(({ onClick, ...rest }, ref) => (
	<div className="form-check">
	  <input
		htmlFor="booty-check"
		type="checkbox"
		className="form-check-input"
		ref={ref}
		onClick={onClick}
		{...rest}
	  />
	  <label className="form-check-label" id="booty-check" />
	</div>
  ));