// import {
//     Form,
//     Head,
//     useForm,
// } from '@inertiajs/react';

// import AppLayout from '@/layouts/custom/app-layout';
// import { Transition } from '@headlessui/react';
// import { Popover, PopoverContent, PopoverTrigger } from '@/components/ui/popover';
// import { Calendar } from '@/components/ui/calendar';
// import { CalendarIcon } from 'lucide-react';
// import { format } from 'date-fns';
// import { cn } from '@/lib/utils';

// export default function () {

//     const {

//         data,
//         setData,
//         // post,
//         // processing,
//         // errors,
//         // reset
//     } = useForm({
//         reservation_date: null as Date | null,
//     });

//     const breadcrumbs: BreadcrumbItem[] = [
//         {
//             title: 'Add Room Reservation Page',
//             href: route('add.room.page'),
//         },
//     ];

//     return (
//         <AppLayout breadcrumbs={breadcrumbs}>
//             <Head title={breadcrumbs[0].title} />
//             <SpecificCustomLayout title='Add Room Reservation' description='Pages for room reservation.'>
//                 <div className="space-y-6">
//                     <HeadingSmall title="Add Room Reservation" description="Here you can reserve room on certain date." />
//                     <Form
//                         method="patch"
//                         action={route('')}
//                         options={{
//                             preserveScroll: true,
//                         }}
//                         className="space-y-6"
//                     >
//                         {({ processing, recentlySuccessful, errors }) => (
//                             <>
//                                 {/* Input Tanggal (shadcn/ui DatePicker) */}
//                                 <div className="space-y-2 flex flex-col">
//                                     <Label>Tanggal Reservasi</Label>
//                                     <Popover>
//                                         <PopoverTrigger asChild>
//                                             <Button
//                                                 variant={"outline"}
//                                                 className={cn(
//                                                     "w-full justify-start text-left font-normal",
//                                                     !data.reservation_date && "text-muted-foreground",
//                                                     errors.joined_at && "border-red-500"
//                                                 )}
//                                             >
//                                                 <CalendarIcon className="mr-2 h-4 w-4" />
//                                                 {data.reservation_date ? format(data.reservation_date, "PPP") : <span>Pilih tanggal</span>}
//                                             </Button>
//                                         </PopoverTrigger>
//                                         <PopoverContent className="w-auto p-0">
//                                             <Calendar
//                                                 mode="single"
//                                                 selected={data.reservation_date ?? undefined}
//                                                 onSelect={(date) => setData('reservation_date', date ?? null)}
//                                                 captionLayout='dropdown-years'
//                                                 autoFocus
//                                             />
//                                         </PopoverContent>
//                                     </Popover>
//                                     {errors.reservation_date && <p className="text-xs text-red-500">{errors.reservation_date}</p>}
//                                 </div>
//                                 <div className="grid gap-2">
//                                     <Label htmlFor="room_code">Room Code</Label>
//                                     <Input
//                                         id="room_code"
//                                         type="room_code"
//                                         className="mt-1 block w-full"
//                                         defaultValue=""
//                                         name="room_code"
//                                         required
//                                         autoComplete="room_code"
//                                         placeholder="Room code"
//                                     />
//                                     <InputError className="mt-2" message={errors.room_code} />
//                                 </div>
//                                 <div className="flex items-center gap-4">
//                                     <Button disabled={processing}>Save</Button>
//                                     <Transition
//                                         show={recentlySuccessful}
//                                         enter="transition ease-in-out"
//                                         enterFrom="opacity-0"
//                                         leave="transition ease-in-out"
//                                         leaveTo="opacity-0"
//                                     >
//                                         <p className="text-sm text-neutral-600">Saved</p>
//                                     </Transition>
//                                 </div>
//                             </>
//                         )}
//                     </Form>
//                 </div>
//             </SpecificCustomLayout>
//         </AppLayout>
//     );
// }

import {
    type BreadcrumbItem
} from '@/types';
import HeadingSmall from '@/components/ui/old/heading-small';
import SpecificCustomLayout from '@/layouts/custom/specific-layout';
import { useForm, Head } from '@inertiajs/react';
import { format } from 'date-fns';
import { CalendarIcon } from 'lucide-react';
import { cn } from '@/lib/utils';
import InputError from '@/components/ui/old/input-error';
import { Button } from '@/components/ui/old/button';
import { Label } from '@/components/ui/old/label';
import { Calendar } from '@/components/ui/calendar';
import { Popover, PopoverContent, PopoverTrigger } from '@/components/ui/popover';
import { Input } from '@/components/ui/old/input';
import { Transition } from '@headlessui/react';
import AppLayout from '@/layouts/custom/app-sidebar-layout-wrapper';

export default function AddRoomReservation() {
    // 1. Inisialisasi useForm dengan semua field yang dibutuhkan
    const {
        data,
        setData,
        patch,
        processing,
        errors,
        recentlySuccessful,
    } = useForm({
        reservation_date: null as Date | null,
        room_code: '', // Tambahkan field ini di sini
    });

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Add Room Reservation Page',
            href: route('add.room.page'),
        },
    ];

    // 2. Fungsi untuk menangani pengiriman data
    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        // Ganti route('') dengan nama route tujuan Anda, misal: 'reservation.update'
        patch(route('reservation.update'), {
            preserveScroll: true,
        });
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={breadcrumbs[0].title} />
            <SpecificCustomLayout title='Add Room Reservation' description='Pages for room reservation.'>
                <div className="space-y-6">
                    <HeadingSmall title="Add Room Reservation" description="Here you can reserve room on certain date." />
                    {/* 3. Gunakan tag form standar dengan onSubmit */}
                    <form onSubmit={handleSubmit} className="space-y-6">
                        {/* Input Tanggal (shadcn/ui DatePicker) */}
                        <div className="space-y-2 flex flex-col">
                            <Label>Tanggal Reservasi</Label>
                            <Popover>
                                <PopoverTrigger asChild>
                                    <Button
                                        variant={"outline"}
                                        className={cn(
                                            "w-full justify-start text-left font-normal",
                                            !data.reservation_date && "text-muted-foreground",
                                            errors.reservation_date && "border-red-500"
                                        )}
                                    >
                                        <CalendarIcon className="mr-2 h-4 w-4" />
                                        {data.reservation_date ? format(data.reservation_date, "PPP") : <span>Pilih tanggal</span>}
                                    </Button>
                                </PopoverTrigger>
                                <PopoverContent className="w-auto p-0" align="start">
                                    <Calendar
                                        mode="single"
                                        selected={data.reservation_date ?? undefined}
                                        onSelect={(date) => setData('reservation_date', date ?? null)}
                                        captionLayout='dropdown-years' // Perbaikan untuk v9 agar dropdown muncul rapi
                                        className=''
                                        autoFocus
                                    />
                                </PopoverContent>
                            </Popover>
                            {errors.reservation_date && <p className="text-xs text-red-500">{errors.reservation_date}</p>}
                        </div>
                        {/* Input Room Code */}
                        <div className="grid gap-2">
                            <Label htmlFor="room_code">Room Code</Label>
                            <Input
                                id="room_code"
                                type="text" // Ubah dari room_code ke text agar valid secara HTML
                                className="mt-1 block w-full"
                                value={data.room_code} // Bind ke state data
                                onChange={(e) => setData('room_code', e.target.value)} // Update via setData
                                name="room_code"
                                required
                                autoComplete="off"
                                placeholder="Room code"
                            />
                            <InputError className="mt-2" message={errors.room_code} />
                        </div>
                        {/* Tombol Aksi */}
                        <div className="flex items-center gap-4">
                            <Button disabled={processing} type="submit">
                                {processing ? "Saving..." : "Save"}
                            </Button>
                            <Transition
                                show={recentlySuccessful}
                                enter="transition ease-in-out"
                                enterFrom="opacity-0"
                                leave="transition ease-in-out"
                                leaveTo="opacity-0"
                            >
                                <p className="text-sm text-neutral-600">Saved</p>
                            </Transition>
                        </div>
                    </form>
                </div>
            </SpecificCustomLayout>
        </AppLayout>
    );
}