<script setup>
import axios from 'axios';



</script>

<template>
    <div>
        <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
           
            <h1 class="mt-8 text-2xl font-medium text-gray-900 dark:text-white">
                Envio de SMS Dunice e Marcon
            </h1>

            <p class="mt-6 text-gray-500 dark:text-gray-400 leading-relaxed">
            Ao enviar um sms, e preciso enteder que ele entra-ra em uma fila de entrega, pois existem remessas do setor de Planejamento sendo entregues<br>
            no momento em que as mensagens são enviadas a partir desta página.
            </p>
            <div class="mt-6 text-gray-500 dark:text-gray-400 leading-relaxed">
              
                <div class="card-body shadow-sm">
                    <div>
                        <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telefone</label>
                        <input type="text" id="small-input" placeholder="6135788484" 
                       
                        
                        class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                       
                    </div>
                    <div class="mb-6">
                        <label for="large-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mensagem</label>
                        <input type="text" id="large-input"
                        class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        
                    </div>
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Enviar SMS</button>
                </div>
            
            </div>
        </div>

        
    </div>
</template>
