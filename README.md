 1. project set up (laravel-inertia-vue)
 2.  Breeze Authentication & Role management
 => user table changed, model c hange and migrate
=> Admin, User registration by default breeze
=>  Home controller, route and view create(without auth role)
=>  HomeLayout create 
=> flowbite setup 

from flowbite .com
-> npm install flowbite
-> Change tailwind config(change plugins)
 require('flowbite/plugin')
 -> change content (add)
"./node_modules/flowbite/**/*.js"

-> import related page 
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'
onMounted(() => {
    initFlowbite();
})

=> AdminController route and view create(without role)
-> AdminLayout create
=> Moderator route and view create (without role)
-> Moderator Layout create
=> User route and view create (without role)
-> User Layout
=> Role management (AuthenticatedSessionController )
  $url = '';
        if($request->user()->role === 'admin'){
            $url ='admin/dashboard';
        }elseif ($request->user()->role === 'instructor'){
            $url = 'instructor/dashboard';
        }elseif($request->user()->role === 'user'){
            $url = 'user/dashboard'; 
        }else{
            $url = '/';
        }
        return redirect()->intended($url);

<!-- ===============admin and user route complete  -->
