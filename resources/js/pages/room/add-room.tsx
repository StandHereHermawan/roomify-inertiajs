import { Transition } from '@headlessui/react';
import {
    Form,
    Head,
    // Link, 
    // usePage
} from '@inertiajs/react';
import HeadingSmall from '@/components/ui/old/heading-small';
import InputError from '@/components/ui/old/input-error';
import { Button } from '@/components/ui/old/button';
import { Input } from '@/components/ui/old/input';
import { Label } from '@/components/ui/old/label';
import {
    // Paginator,
    // Room,
    type BreadcrumbItem
} from '@/types';
import AppLayout from '@/layouts/custom/app-sidebar-layout-wrapper';
import SpecificCustomLayout from '@/layouts/custom/specific-layout';
import { useState, ChangeEvent } from 'react';

export default function () {

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Add Room Page',
            href: route('add.room.page'),
        },
    ];


    // Di dalam komponen React Anda:
    const [imagePreview, setImagePreview] = useState<string | null>();

    const handleImageChange = (event: ChangeEvent<HTMLInputElement>) => {
        const file = event.target.files?.[0];
        if (file) {
            // Validasi tipe file sisi client.
            if (['image/jpeg', 'image/png', 'image/jpg'].includes(file.type)) {
                setImagePreview(URL.createObjectURL(file));
            } else {
                alert('Format file tidak didukung! Harap unggah file JPG, JPEG, atau PNG.');
                event.target.value = ''; // Reset input
                setImagePreview(null);
            }
        } else {
            setImagePreview(null);
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={breadcrumbs[0].title} />
            <SpecificCustomLayout title='Add Room'>
                <div className="space-y-6">
                    <HeadingSmall title="Add New Room" description="New room data to databases." />
                    <Form
                        method="post"
                        action={route('add.room')}
                        options={{
                            preserveScroll: true,
                        }}
                        className="space-y-6"
                    >
                        {({ processing, recentlySuccessful, errors }) => (
                            <>
                                <div className="grid gap-2">
                                    <Label htmlFor="name">Room Name (Example: Ruang Kelas)</Label>
                                    <Input
                                        id="name"
                                        className="mt-1 block w-full"
                                        defaultValue=""
                                        name="name"
                                        required
                                        autoComplete="name"
                                        placeholder="Room name"
                                    />
                                    <InputError className="mt-2" message={errors.name} />
                                </div>
                                <div className="grid gap-2">
                                    <Label htmlFor="room_code">Room Code (Example: B-218)</Label>

                                    <Input
                                        id="room_code"
                                        type="text"
                                        className="mt-1 block w-full"
                                        defaultValue=""
                                        name="room_code"
                                        required
                                        autoComplete="room_code"
                                        placeholder="Room code"
                                    />

                                    <InputError className="mt-2" message={errors.room_code} />
                                </div>
                                <div className="grid gap-2">
                                    <Label htmlFor="description">Room Description</Label>

                                    <Input
                                        id="description"
                                        type="description"
                                        className="mt-1 block w-full"
                                        defaultValue=""
                                        name="description"
                                        autoComplete="description"
                                        placeholder="Room description"
                                    />

                                    <InputError className="mt-2" message={errors.description} />
                                </div>
                                <div className="grid gap-2">
                                    <Label htmlFor="height_in_meter">Height in Meter (Example: 3.25 or 3)</Label>

                                    <Input
                                        id="height_in_meter"
                                        type="height_in_meter"
                                        className="mt-1 block w-full"
                                        defaultValue=""
                                        name="height_in_meter"
                                        autoComplete="height_in_meter"
                                        placeholder="Height in meter"
                                    />

                                    <InputError className="mt-2" message={errors.height_in_meter} />
                                </div>
                                <div className="grid gap-2">
                                    <Label htmlFor="floor_wide_in_meter_squared">Floor Wide In Meter Squared. (Example: 30.25 or 30)</Label>

                                    <Input
                                        id="floor_wide_in_meter_squared"
                                        type="floor_wide_in_meter_squared"
                                        className="mt-1 block w-full"
                                        defaultValue=""
                                        name="floor_wide_in_meter_squared"
                                        autoComplete="floor_wide_in_meter_squared"
                                        placeholder="Floor wide in meter squared"
                                    />

                                    <InputError className="mt-2" message={errors.floor_wide_in_meter_squared} />
                                </div>

                                {/* FIELD GAMBAR & PREVIEW */}
                                <div className="grid gap-2">
                                    <Label htmlFor="image">Room Image</Label>
                                    <Input
                                        id="image"
                                        type="file"
                                        name="image"
                                        accept=".jpg,.jpeg,.png,image/jpeg,image/png"
                                        className="mt-1 block w-full cursor-pointer"
                                        onChange={handleImageChange}
                                    />
                                    <InputError className="mt-2" message={errors.image} />

                                    {/* Tampilan Preview Gambar */}
                                    {imagePreview ? (
                                        <div className="mt-3">
                                            <p className="text-sm text-gray-500 mb-2">Image Preview:</p>
                                            <div className="relative w-40 h-40 rounded-lg overflow-hidden border border-gray-200">
                                                <img
                                                    src={imagePreview}
                                                    alt="Room Preview"
                                                    className="w-full h-full object-cover"
                                                />
                                            </div>
                                        </div>
                                    ) : (
                                        /* Inline SVG Ikon Kamera Native */
                                        <div className="mt-3">
                                            <p className="text-sm text-gray-500 mb-2">Image Preview:</p>
                                            <div className="relative w-40 h-40 rounded-lg overflow-hidden border border-gray-200">
                                                <div className="flex flex-col items-center justify-center text-gray-400 gap-1">
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        strokeWidth={1.5}
                                                        stroke="currentColor"
                                                        className="w-8 h-8 text-gray-400"
                                                    >
                                                        <path
                                                            strokeLinecap="round"
                                                            strokeLinejoin="round"
                                                            d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574v9.176A2.25 2.25 0 0 0 4.5 21h15a2.25 2.25 0 0 0 2.25-2.25V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z"
                                                        />
                                                        <path
                                                            strokeLinecap="round"
                                                            strokeLinejoin="round"
                                                            d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z"
                                                        />
                                                    </svg>
                                                    <span className="text-xs text-gray-400">No Image</span>
                                                </div>
                                            </div>
                                        </div>
                                    )}
                                </div>

                                <div className="flex items-center gap-4">
                                    <Button disabled={processing}>Save</Button>

                                    <Transition
                                        show={recentlySuccessful}
                                        enter="transition ease-in-out"
                                        enterFrom="opacity-0"
                                        leave="transition ease-in-out"
                                        leaveTo="opacity-0"
                                    >
                                        <p className="text-sm text-neutral-600">Sended</p>
                                    </Transition>
                                </div>
                            </>
                        )}
                    </Form>
                </div>
            </SpecificCustomLayout>
        </AppLayout>
    );
}
