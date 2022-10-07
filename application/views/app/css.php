<style type="text/css">

	::selection {
		background-color: #E13300;
		color: white;
	}
	::-moz-selection {
		background-color: #E13300;
		color: white;
	}

	.body {
		background-color: #fff;
		margin: 0px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
		overflow: scroll;
	}

	.body a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
		text-decoration: none;
	}

	.body a:hover {
		color: #97310e;
	}

	.body h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	.body code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	.body .body-container{
		position:	absolute;
		z-index:	-1;
		overflow:	auto;
		height:		100%;
		left:		0px;
	}
	@media( max-width: 499px ){
		.body .body-container{
			width:			100%;
			padding-left:	0px;
			padding-right:	0px;
		}
	}
	@media( min-width: 500px ){
		.body .body-container{
			width: calc( 100% - 80px );
			padding-left:	40px;
			padding-right:	40px;
		}
	}
	.body .top-button-page-container{
		position:		absolute;
		pointer-events: none;
		width:			100%;
		height:			100%;
		top:			0;
		z-index: 		1;
	}
	.body .alerts-page-container{
		position:		absolute;
		width: 			100%;
		height:			100%;
		pointer-events: none;
		z-index: 		1;
	}
	.body .alerts{
		position:		absolute;
		background:		#F9F9F9;
		width: 			calc( 100% - 50px );
		top:			2%;
		border:			1px solid black;
		font-size:		16px;
		word-break: 	break-word;
		display:		flex;
		pointer-events: all;
		transform:		translateY(-50%);
	}
	.body .alerts-close{
		cursor:			pointer;
		padding-left:	1em;
		padding-right:	1em;
		padding-top: 	1em;
		padding-bottom: 1em;
		font-size: 		18px;
	}
	.body .alerts-container{
		text-align:		center;
		width: 			100%;
		padding-top: 	1em;
		padding-bottom: 1em;
		cursor: 		pointer;
	}

	.body .nav{
		margin-left: -29px;
	}
	.body .nav * {
		display: flex;
		gap: 0.3em;
	}
	.body .bold{
		font-weight: bold;
	}
	.body .body {
		margin: 0 15px 0 15px;
		min-height: 96px;
	}

	.body p {
		margin: 0 0 10px;
		padding:0;
	}

	.body p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	.body .container {
		margin: 0px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}

	@media( min-width: 769px ){
		.body .container {
			margin: 10px;
		}
	}
	.body .pointer{
		cursor: pointer;
	}
	.body input{
		border: none;
		border-bottom: 1px solid rgba(0,0,0,.3);
		transition: 0.5s;
	}
	.body input:not([type="checkbox"]){
		width: 100%;
	}
	.body :focus-visible {
		outline: -webkit-focus-ring-color auto 0px;
		border-bottom: 1px solid blue;
	}
	.body label{
		display: block;
		position: relative;
		margin-top: 25px;
		margin-left: 1em;
		margin-right: 1em;
	}
	.body .label{
		position: absolute;
		top: 0;
		z-index: 1;
		transition: 0.3s;
		font-weight: bold;
		pointer-events: none;
	}
	.body label .label-up + .label,
	label input:focus + .label{
		top: -20px;
		color: blue;
	}
	.body error{
		color: red;
		font-weight: bold;
	}
	.body .flex{
		display: flex;
	}
	.body .wrap{
		flex-wrap: wrap;
	}
	.body .hover{
		transition: 0.3s;
	}
	.body .hover:hover{
		box-shadow: 0 0 15px rgba(0,0,0,.3) inset, 0 0 1px rgba(0,0,0,.3);
	}
	.body .button {
		background-color: #0095ff;
		border: 1px solid transparent;
		border-radius: 3px;
		box-shadow: rgba(255, 255, 255, .4) 0 1px 0 0 inset;
		box-sizing: border-box;
		color: #fff !important;
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
	.body .button:hover,
	.body .button:focus {
		background-color: #07c;
	}

	.body .button:focus {
		box-shadow: 0 0 0 4px rgba(0, 149, 255, .15);
	}
	.body .button:active {
		background-color: #0064bd;
		box-shadow: none;
	}
	.body .mini{
		padding: 0.5em;
		border-radius: 0;
	}
	.body .red{
		background-color: #cc0000;
	}
	.body .red:hover,
	.body .red:focus {
		background-color: #900;
	}
	.body .red:active {
		background-color: #800;
		box-shadow: none;
	}
	.body .green{
		background-color: #008800;
	}
	.body.green:hover,
	.body .green:focus {
		background-color: #060;
	}
	.body .green:active {
		background-color: #050;
		box-shadow: none;
	}
	.body .none{
		display: none;
	}
	.body .text-red{
		color: red;
	}
	.body .text-blue{
		color: blue;
	}
	.body .text-green{
		color: #006600;
	}
	.body .text-gray{
		color:  rgba( 0,0,0,.3 );
	}
	.body .time{
		position:		absolute;
		width:			100%;
		height:			100%;
		pointer-events:	none;
		z-index: 		1;
	}
	.body .time-container{
		position:		absolute;
		width:			175px;
		border: 		1px solid black;
		pointer-events: all;
	}
	.body .time-box{
		display:		flex;
	}

	.body .overflow{
		overflow: auto;
	}
	.body .table{
		width: 100%;
		border-collapse: collapse;
	}
	.body .table tr{
		transition:		0.3s
	}
	.body .table tr:hover{
		box-shadow:		0 0 10px rgba( 0, 0, 0, .5 );
	}
	.body .table td{
		border:			1px solid rgba( 0,0,0,.1 );
		white-space:	normal;
		/* padding:		1em; */
		vertical-align:	top;
		transition:		0.3s
	}
	.body .table td:hover{
		box-shadow:		0 0 10px rgba( 0, 0, 0, .5 );
	}

	.body .text-right{
		text-align: right;
	}
	.body .text-center{
		text-align: center;
	}
	.body .column{
		flex-direction: column;
	}
	.body .gap-1em{
		gap: 1em;
	}
	.body .pt-1em{
		padding-top: 1em;
	}
	.body .pb-3em{
		padding-bottom: 3em;
	}
	.body .p-1em{
		padding: 1em;
	}
	.body .pl-1em{
		padding-left: 1em;
	}
	.body .pt-1em{
		padding-top: 1em;
	}
	.body .no-break{
		white-space: nowrap;
	}
	.body .mr-1em{
		margin-right: 1em;
	}
	@media( max-width: 768px ){
		.body .ccard > *{
			flex-grow: 1;
			flex-basis: 100%;
		}
	}
	@media( min-width: 769px ){
		.body .ccard > *{
			flex-grow: 1;
		}
	}
	@media( max-width: 768px ){
		.body .cform > *{
			flex-basis: 100%;
		}
	}
	@media( min-width: 769px ){
		.body .cform > *{
			flex-basis: calc( 100% / 3 );
		}
		.body .cform > .esp1 {
			flex-basis: 100%;
		}
		.body .cform > .esp2 {
			flex-basis: calc( (100% / 3) * 2 );
		}
	}
	@media( max-width: 768px ){
		.body .cpaginator > *{
			flex-grow: 1;
			flex-basis: 100%;
		}
	}
	@media( min-width: 769px ){
		.body .cpaginator > *{
			flex-grow: 1;
		}
	}
	.body .grow{
		flex-grow: 1
	}
	.body .selectable{
		position: absolute;
		z-index: 10;
		right: 0;
		width: calc( 100% - 30px )
	}
	.body .select-button-1{
		position: absolute;
		z-index: 10;
		width: 30px;
		left: 0;
	}
	.body .date{
		position:		absolute;
		width:			100%;
		height:			100%;
		pointer-events: none;
	}
	.body .date-container{
		position:		absolute;
		pointer-events: all;
	}
	.body .date-box{
		position:	absolute;
		display:	flex;
		width:		200px;
	}
	.body .floating-top-button{
		bottom: 			0.3em;
		right: 				0.3em;
		position:			absolute;
		font-size:			28px;
		transform:			rotate(-90deg);
		background:			#DDD;
		padding:			0.3em;
		border-radius:		100%;
		pointer-events:		all;
		cursor:				pointer;
		opacity:			0.7;
		transition:			0.3s;
	}
	.body .floating-top-button:hover{
		opacity: 1;
		padding: 0.4em;
	}
</style>