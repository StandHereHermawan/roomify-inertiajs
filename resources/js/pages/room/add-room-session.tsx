import { Transition } from '@headlessui/react';
import {
    Form,
    Head,
} from '@inertiajs/react';
import HeadingSmall from '@/components/ui/old/heading-small';
import InputError from '@/components/ui/old/input-error';
import { Button } from '@/components/ui/old/button';
import { Input } from '@/components/ui/old/input';
import { Label } from '@/components/ui/old/label';
import {
    type BreadcrumbItem
} from '@/types';
import AppLayout from '@/layouts/custom/app-sidebar-layout-wrapper';
import SpecificCustomLayout from '@/layouts/custom/specific-layout';

export default function () {

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Add Room Session Page',
            href: route('add.room.page'),
        },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={breadcrumbs[0].title} />
            <SpecificCustomLayout title='Add Room Session' description='Pages for adding room session.'>
                <div className="space-y-6">
                    <HeadingSmall title="Add Room Session" description="Here you can adding room session." />
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
                                    <Label htmlFor="session_start">Room Session Start</Label>
                                    <Input
                                        id="session_start"
                                        type="session_start"
                                        className="mt-1 block w-full"
                                        defaultValue=""
                                        name="session_start"
                                        required
                                        autoComplete="session_start"
                                        placeholder="Session start"
                                    />
                                    <InputError className="mt-2" message={errors.session_start} />
                                </div>
                                <div className="grid gap-2">
                                    <Label htmlFor="session_end">Room Session End</Label>
                                    <Input
                                        id="session_end"
                                        type="session_end"
                                        className="mt-1 block w-full"
                                        defaultValue=""
                                        name="session_end"
                                        required
                                        autoComplete="session_end"
                                        placeholder="Session end"
                                    />
                                    <InputError className="mt-2" message={errors.session_end} />
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
