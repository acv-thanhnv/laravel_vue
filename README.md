<p><strong>Date: 2018/10/10</strong></p>
<p><strong>Required:</strong></p>
<p><strong>&nbsp;-&nbsp; </strong>Laravel framework 5.6</p>
<p><strong>&nbsp;-&nbsp;&nbsp;</strong>MySql version &gt;= 5.7.23</p>
<p><span style="color: #3366ff;"><strong>Config:</strong></span></p>
<p>- The first checkout : run composor install.</p>
<p>- Run migration, migration will run script file&nbsp;<strong>dbscript/for_migration_init_database.sql</strong></p>
<p><strong>- Provider </strong>of modules must registed in<strong> config/app.</strong></p>
<p><span style="color: #3366ff;"><strong>CODE:</strong></span></p>
<p><strong>1.Backend Module.</strong></p>
<p><strong>&nbsp;- Required:&nbsp;</strong>Core module</p>
<p><strong>&nbsp;-</strong>&nbsp;Provide some template feature as upload file ( upload to local storage and Amazon Storage service), Export/Import excel,csv...</p>
<p><strong>2.ACL Module.</strong></p>
<p><strong>&nbsp;- Required:&nbsp;</strong>Core module</p>
<p><strong>&nbsp;-</strong> Acl management for user, define&nbsp;<strong>policy</strong> for access all of action.</p>
<p><strong>3. Dev Module.</strong></p>
<p><strong>&nbsp;-</strong>&nbsp;As<strong>&nbsp;</strong>helper feature for Developer config project ( refer DETAIL )</p>
<p><strong>4. DAO component</strong></p>
<p><strong>&nbsp;-&nbsp;</strong>As data access object, help excute and standardized output from <strong>Store procedure&nbsp;</strong></p>
<p><strong>5. Entity</strong></p>
<p><strong>&nbsp;</strong>- As entity class, define ouput structure of entity data from Database.</p>
<p><strong>6. New log mode</strong></p>
<p><strong>&nbsp;-&nbsp;</strong>If you change .env&nbsp;LOG_CHANNEL to custom, logs will writed <span style="color: #000000;">by</span> custom policy:</p>
<p>&nbsp; &nbsp; &nbsp;+ Write log with new structure&nbsp; logs/date_folder/module_date.txt</p>
<p>&nbsp; &nbsp; &nbsp;+ Logger for database query excuted if set .env&nbsp;DB_LOG=true</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; ( listen to Database Event in&nbsp; <strong>AppServiceProvider</strong>.<strong><em>boot</em></strong>() )</p>
<p>&nbsp; &nbsp; &nbsp;+ All of default event logs still perform as default of Laravel.</p>
<p>&nbsp; &nbsp; &nbsp;+ Coding struct like default of Laravel.</p>
<p><strong>7. Helper</strong></p>
<p><strong>&nbsp; -</strong> Provide some helper for developer.</p>
<p><strong>8. Console: Generate access token key</strong></p>
<p><strong>&nbsp;&nbsp;</strong>- Ex: php artisan access-token:generate <a href="mailto:your_email@mail.com">your_email@mail.com</a>&nbsp; &nbsp;&nbsp;<br />&nbsp; =&gt; generate a access token key with specific roles, which use to help client access api.<strong><br /><br /></strong></p>
<p>--------------------------------------------------------------------------------------------------------------------------</p>
<h2><span style="color: #333399;"><strong>DETAIL</strong></span></h2>
<p><span style="color: #333399;"><strong>DEV Module.</strong></span></p>
<p><strong>Required:</strong>&nbsp;</p>
<p>&nbsp;- file .env has "DEV_MODE = true" .</p>
<p><strong>1. Initialization project</strong><br />&nbsp;- Click button [<strong>Reset &amp; Innitization</strong>] to generate common config (ACL file, Translation file...), import list of action to Database.</p>
<p>&nbsp;- Click button [<strong>Reset &amp; import translation</strong>] to innitization translation data ( remove and init data in database).</p>
<p>&nbsp;- CLick button <strong>[Import translation]&nbsp;</strong>to&nbsp;Get data translation from Other server, server information has must configed inside .env&nbsp;</p>
<p><strong>2. Translation</strong></p>
<p><strong>&nbsp;- Translation page </strong>management&nbsp; based on languages.</p>
<p>&nbsp;- Add new, Update, Remove text.</p>
<p>&nbsp;- Generate translations file from Database. ( Database to Code)</p>
<p>&nbsp;- Import data from translation file to Database.( Code to Database)</p>
<p><strong>3. ACL - Roles</strong></p>
<p><strong>&nbsp;</strong>- Acl management, change access permission for each user roles.</p>
<p><strong>&nbsp;-&nbsp;</strong>Generate ACL file based on Database to Project code. ( Database to Code)</p>
<p>&nbsp;-&nbsp;Synchronously if has changed code ( if you add new action, module or controller. you should run <strong>synchrously&nbsp;</strong> to update data acl)</p>
<p><strong>4. User-Role</strong></p>
<p>&nbsp;- Setting role for users.</p>
<p><strong>5. Category</strong></p>
<p>&nbsp;- Template insert, update, delete&nbsp; category.</p>
<p>&nbsp;</p>
<p><span style="color: #333399;"><strong>Acl Module</strong></span></p>
<p><span style="color: #333399;"><strong>-&nbsp;</strong><span style="color: #000000;"> Defined rule of <strong>access police&nbsp;</strong></span><span style="color: #000000;">in acl middleware.</span></span></p>
<p><span style="color: #333399;"><span style="color: #000000;">-&nbsp; Apply for all of action has registed "acl" middleware.</span></span></p>
<p><span style="color: #333399;"><span style="color: #000000;">&nbsp;</span></span></p>
<h3><strong>NOTE for developer:</strong><br /><br /></h3>
<p>- Generate migrate script by below steps:</p>
<p>+ Export script from database.</p>
<p>+ Remove "DELIMITER;;","DELIMITER;","DEFINER=`root`@`%`" ( inside create store procedure, function command)</p>
<p>+ Replace "END;;" to "END;"</p>
<p>+ Remove ";;"</p>
<p>&nbsp;</p>
