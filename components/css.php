<style type="text/css">

	::selection {
		background-color: #E13300;
		color: white;
	}
	::-moz-selection {
		background-color: #E13300;
		color: white;
	}

	body {
		background-color: #fff;
		margin: 0px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
		overflow: hidden;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
		text-decoration: none;
	}

	a:hover {
		color: #97310e;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	.body-container{
		position:	absolute;
		z-index:	-1;
		overflow:	auto;
		height:		100%;
		left:		0px;
	}
	@media( max-width: 499px ){
		.body-container{
			width:			100%;
			padding-left: 0px;
			padding-right: 0px;
		}
	}
	@media( min-width: 500px ){
		.body-container{
			width: calc( 100% - 80px );
			padding-left: 40px;
			padding-right: 40px;
		}
	}
	.alerts-page-container{
		position:		absolute;
		width: 			100%;
		height:			100%;
		pointer-events: none;
		z-index: 		1;
	}
	.alerts{
		background:		#F9F9F9;
		position:		absolute;
		width: 			100%;
		border:			1px solid black;
		font-size:		16px;
		word-break: 	break-word;
		display:		flex;
		pointer-events: all;
	}
	.alerts-close{
		cursor:			pointer;
		padding-left:	1em;
		padding-right:	1em;
		padding-top: 	1em;
		padding-bottom: 1em;
		font-size: 		18px;
	}
	.alerts-container{
		text-align:		center;
		width: 			100%;
		padding-top: 	1em;
		padding-bottom: 1em;
	}

	.nav{
		margin-left: -29px;
	}
	.nav * {
		display: flex;
		gap: 0.3em;
	}
	.bold{
		font-weight: bold;
	}
	.body {
		margin: 0 15px 0 15px;
		min-height: 96px;
	}

	p {
		margin: 0 0 10px;
		padding:0;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	.container {
		margin: 0px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}

	@media( min-width: 769px ){
		.container {
			margin: 10px;
		}
	}
	.pointer{
		cursor: pointer;
	}
	input{
		border: none;
		border-bottom: 1px solid rgba(0,0,0,.3);
		transition: 0.5s;
	}
	input:not([type="checkbox"]){
		width: 100%;
	}
	:focus-visible {
		outline: -webkit-focus-ring-color auto 0px;
		border-bottom: 1px solid blue;
	}
	label{
		display: block;
		position: relative;
		margin-top: 25px;
		margin-left: 1em;
		margin-right: 1em;
	}
	.label{
		position: absolute;
		top: 0;
		z-index: 1;
		transition: 0.3s;
		font-weight: bold;
		pointer-events: none;
	}
	label .label-up + .label,
	label input:focus + .label{
		top: -20px;
		color: blue;
	}
	error{
		color: red;
		font-weight: bold;
	}
	.flex{
		display: flex;
	}
	.wrap{
		flex-wrap: wrap;
	}
	.hover{
		transition: 0.3s;
	}
	.hover:hover{
		box-shadow: 0 0 15px rgba(0,0,0,.3) inset, 0 0 1px rgba(0,0,0,.3);
	}
	.button {
		background-color: #0095ff;
		border: 1px solid transparent;
		border-radius: 3px;
		box-shadow: rgba(255, 255, 255, .4) 0 1px 0 0 inset;
		box-sizing: border-box;
		color: #fff;
		cursor: pointer;
		display: inline-block;
		font-family: -apple-system,system-ui,"Segoe UI","Liberation Sans",sans-serif;
		font-size: 13px;
		font-weight: 400;
		line-height: 1.15385;
		margin: 0;
		outline: none;
		padding: 8px .8em;
		position: relative;
		text-align: center;
		text-decoration: none;
		user-select: none;
		-webkit-user-select: none;
		touch-action: manipulation;
		vertical-align: baseline;
		white-space: nowrap;
		transition: 0.3s;
	}
	.button:hover,
	.button:focus {
		background-color: #07c;
	}

	.button:focus {
		box-shadow: 0 0 0 4px rgba(0, 149, 255, .15);
	}
	.button:active {
		background-color: #0064bd;
		box-shadow: none;
	}
	.mini{
		padding: 0.5em;
		border-radius: 0;
	}
	.red{
		background-color: #cc0000;
	}
	.red:hover,
	.red:focus {
		background-color: #900;
	}
	.red:active {
		background-color: #800;
		box-shadow: none;
	}
	.green{
		background-color: #008800;
	}
	.green:hover,
	.green:focus {
		background-color: #060;
	}
	.green:active {
		background-color: #050;
		box-shadow: none;
	}
	.none{
		display: none;
	}
	.text-red{
		color: red;
	}
	.text-blue{
		color: blue;
	}
	.text-green{
		color: #006600;
	}
	.text-gray{
		color:  rgba( 0,0,0,.3 );
	}
	.time{
		position:		absolute;
		width:			100%;
		height:			100%;
		pointer-events:	none;
		z-index: 		1;
	}
	.time-container{
		position:		absolute;
		width:			175px;
		border: 		1px solid black;
		pointer-events: all;
	}
	.time-box{
		display:		flex;
	}

	.overflow{
		overflow: auto;
	}
	.table{
		width: 100%;
		border-collapse: collapse;
	}
	.table tr{
		transition:		0.3s
	}
	.table tr:hover{
		box-shadow:		0 0 10px rgba( 0, 0, 0, .5 );
	}
	.table td{
		border:			1px solid rgba( 0,0,0,.1 );
		white-space:	nowrap;
		padding:		1em;
		vertical-align:	top;
		transition:		0.3s
	}
	.table td:hover{
		box-shadow:		0 0 10px rgba( 0, 0, 0, .5 );
	}

	.text-right{
		text-align: right;
	}
	.text-center{
		text-align: center;
	}
	.column{
		flex-direction: column;
	}
	.gap-1em{
		gap: 1em;
	}
	.pt-1em{
		padding-top: 1em;
	}
	.pb-3em{
		padding-bottom: 3em;
	}
	.p-1em{
		padding: 1em;
	}
	.pl-1em{
		padding-left: 1em;
	}
	.pt-1em{
		padding-top: 1em;
	}
	.no-break{
		white-space: nowrap;
	}
	.mr-1em{
		margin-right: 1em;
	}
	@media( max-width: 768px ){
		.ccard > *{
			flex-grow: 1;
			flex-basis: 100%;
		}
	}
	@media( min-width: 769px ){
		.ccard > *{
			flex-grow: 1;
		}
	}
	@media( max-width: 768px ){
		.cform > *{
			flex-basis: 100%;
		}
	}
	@media( min-width: 769px ){
		.cform > *{
			flex-basis: calc( 100% / 3 );
		}
		.cform > .esp1 {
			flex-basis: 100%;
		}
		.cform > .esp2 {
			flex-basis: calc( (100% / 3) * 2 );
		}
	}
	@media( max-width: 768px ){
		.cpaginator > *{
			flex-grow: 1;
			flex-basis: 100%;
		}
	}
	@media( min-width: 769px ){
		.cpaginator > *{
			flex-grow: 1;
		}
	}
	.grow{
		flex-grow: 1
	}
	.selectable{
		position: absolute;
		z-index: 10;
		right: 0;
		width: calc( 100% - 30px )
	}
	.select-button-1{
		position: absolute;
		z-index: 10;
		width: 30px;
		left: 0;
	}
	.date{
		position:		absolute;
		width:			100%;
		height:			100%;
		pointer-events: none;
	}
	.date-container{
		position:		absolute;
		pointer-events: all;
	}
	.date-box{
		position:	absolute;
		display:	flex;
		width:		200px;
	}
</style>