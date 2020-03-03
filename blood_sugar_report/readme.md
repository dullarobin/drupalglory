Phase1:: 
--------------------- USER FLOW -----------------------------
Step1: Login with superadmin user and Intall the module Blood Sugar Record
Step2: Run update.php, In case there is no update. Please once go to the install file and change the hook_update_n
Update from: blood_sugar_report_update_8005 to blood_sugar_report_update_8006
Step3: Create a new user and assign role Blood Sugar Users(This role will be in roles after installing the module)
Step4: On login with new user, user'll redirect to myspace page
Step5. On myspace page, User have Enter blood sugar value(BSV) form where user can enter BSV value b/w 0-10.
Below BSV form, User have BSV listing below.
Step6. On entering BSV, User will get the Add Prescription option. On click Add Prescription 
button user'll get a pop for prescription upload. Prescription will below

Phase2:: 
-------------------- ADMIN FLOW -----------------------------
Step1: Login with superadmin user and Intall the module Blood Sugar Record
Step2: For Admin flow need to hit the given url($base_url/report_admin_view) 
Step3. On hitting above url User will get complete overview of Blood sugar value and prescription file record.
and option for Configure settings and Create more admins
---------------------------------------------------------------

Note: In case layout broke at your end one please check block order in Block-- 'Content'.
Order should be:
Main page content
Blood Sugar Report
Upload Prescription
Admin Report View: BS Level Full
Admin Report View 1