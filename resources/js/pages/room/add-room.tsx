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

export default function () {

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Add Room Page',
            href: route('add.room.page'),
        },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={breadcrumbs[0].title} />
            <SpecificCustomLayout title='Add Room'>
                <div className="space-y-6">
                    <HeadingSmall title="Add New Room" description="New room data to databases." />
                    <Form
                        method="patch"
                        action={route('')}
                        options={{
                            preserveScroll: true,
                        }}
                        className="space-y-6"
                    >
                        {({ processing, recentlySuccessful, errors }) => (
                            <>
                                <div className="grid gap-2">
                                    <Label htmlFor="name">Room Name</Label>
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
                                    <Label htmlFor="room_code">Room Code</Label>

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
                                    <Label htmlFor="height_in_meter">Height in Meter</Label>

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
                                    <Label htmlFor="height_in_meter">Floor Wide In Meter Squared</Label>

                                    <Input
                                        id="height_in_meter"
                                        type="height_in_meter"
                                        className="mt-1 block w-full"
                                        defaultValue=""
                                        name="height_in_meter"
                                        autoComplete="height_in_meter"
                                        placeholder="Floor wide in meter squared"
                                    />

                                    <InputError className="mt-2" message={errors.height_in_meter} />
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
                                        <p className="text-sm text-neutral-600">Saved</p>
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
