import { Transition } from '@headlessui/react';
import InputError from '@/components/ui/old/input-error';
import { Button } from '@/components/ui/old/button';
import { Input } from '@/components/ui/old/input';
import { Label } from '@/components/ui/old/label';
import {
    type BreadcrumbItem
} from '@/types';
import { Form, Head } from '@inertiajs/react';
import AppLayout from '@/layouts/custom/app-layout';
import SpecificCustomLayout from '@/layouts/custom/specific-layout';
import HeadingSmall from '@/components/ui/old/heading-small';

export default function () {

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Add Role Page',
            href: '',
        },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={breadcrumbs[0].title} />
            <SpecificCustomLayout title='Add Roles For User' description='Pages for add roles one by one.'>
                <div className="space-y-6">
                    <HeadingSmall title="Add Roles For User" description="Here you can add roles one by one." />
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
                                    <Label htmlFor="role">Role Name</Label>
                                    <Input
                                        id="role"
                                        type="role"
                                        className="mt-1 block w-full"
                                        defaultValue=""
                                        name="role"
                                        required
                                        autoComplete="role"
                                        placeholder="Role name"
                                    />
                                    <InputError className="mt-2" message={errors.room_code} />
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
