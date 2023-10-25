import { router } from '@inertiajs/vue3';
import axios from 'axios';
import { ref, inject } from 'vue';
import { useRoute } from 'vue-router';

export default function useSendsms() {
    const dataForm = ref([]);

    const route = useRoute();
    const validationErrors = ref([]);
    const isLoading = ref(false);
    const swal = inject('$swal');

        const sendSms = async (data) => {
            if(isLoading.value) return;
            
            isLoading.value = true
            validationErrors.value = {}

            let serializedPost = new FormData()
            for (let item in dataForm) {
                if (dataForm.hasOwnProperty(item)) {
                    serializedPost.append(item, dataForm[item])
                }
            }

        //console.log(serializedPost)

        axios.post('/api/sendsmss', serializedPost)
            .then(response => {
                router.push({ name: 'sendsms' })
                swal({
                    icon: 'success',
                    title: 'message send successfully'
                })
            })
        }

        return {
            dataForm,
            sendSms,
            validationErrors,
            isLoading
        }





}