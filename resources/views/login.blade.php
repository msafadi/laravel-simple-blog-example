<x-front-layout title="Login">

    <section class="s-content">
        <form action="{{ route('login') }}" method="post">
            @csrf
    
            <x-alert type="danger" name="error" />
    
            <div>
                <input name="email" type="email" placeholder="Email">
            </div>
            <div>
                <input name="password" type="password" placeholder="Paswword">
            </div>
    
            <div>
                <button type="submit">Login</button>
            </div>
            
        </form>
    </section>
    

</x-front-layout>