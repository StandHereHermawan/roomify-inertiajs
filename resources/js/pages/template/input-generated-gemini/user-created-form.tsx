import React from 'react';
import { useForm, Head } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/old/label';
import { Calendar } from '@/components/ui/calendar';
import { Popover, PopoverContent, PopoverTrigger } from '@/components/ui/popover';
import { format } from 'date-fns';
import { CalendarIcon, Loader2 } from 'lucide-react';
import { cn } from '@/lib/utils';

export default function UserCreateForm() {
    // 1. Inisialisasi useForm
    const { data, setData, post, processing, errors, reset } = useForm({
        name: '',
        email: '',
        joined_at: null as Date | null,
    });

    // 2. Handler Submit
    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        post('/users', {
            onSuccess: () => reset(), // Reset form jika berhasil
        });
    };

    return (
        <div className="max-w-md mx-auto p-6 bg-white rounded-xl shadow-md">
            <Head title="Create User" />
            <h2 className="text-2xl font-bold mb-6">Tambah Pengguna</h2>

            <form onSubmit={handleSubmit} className="space-y-4">
                {/* Input Nama */}
                <div className="space-y-2">
                    <Label htmlFor="name">Nama Lengkap</Label>
                    <Input
                        id="name"
                        value={data.name}
                        onChange={(e) => setData('name', e.target.value)}
                        placeholder="Masukkan nama..."
                        className={errors.name ? 'border-red-500' : ''}
                    />
                    {errors.name && <p className="text-xs text-red-500">{errors.name}</p>}
                </div>

                {/* Input Email */}
                <div className="space-y-2">
                    <Label htmlFor="email">Email</Label>
                    <Input
                        id="email"
                        type="email"
                        value={data.email}
                        onChange={(e) => setData('email', e.target.value)}
                        placeholder="email@contoh.com"
                        className={errors.email ? 'border-red-500' : ''}
                    />
                    {errors.email && <p className="text-xs text-red-500">{errors.email}</p>}
                </div>

                {/* Input Tanggal (shadcn/ui DatePicker) */}
                <div className="space-y-2 flex flex-col">
                    <Label>Tanggal Bergabung</Label>
                    <Popover>
                        <PopoverTrigger asChild>
                            <Button
                                variant={"outline"}
                                className={cn(
                                    "w-full justify-start text-left font-normal",
                                    !data.joined_at && "text-muted-foreground",
                                    errors.joined_at && "border-red-500"
                                )}
                            >
                                <CalendarIcon className="mr-2 h-4 w-4" />
                                {data.joined_at ? format(data.joined_at, "PPP") : <span>Pilih tanggal</span>}
                            </Button>
                        </PopoverTrigger>
                        <PopoverContent className="w-auto p-0">
                            <Calendar
                                mode="single"
                                selected={data.joined_at ?? undefined}
                                onSelect={(date) => setData('joined_at', date ?? null)}
                                initialFocus
                            />
                        </PopoverContent>
                    </Popover>
                    {errors.joined_at && <p className="text-xs text-red-500">{errors.joined_at}</p>}
                </div>

                {/* Tombol Submit */}
                <Button type="submit" className="w-full" disabled={processing}>
                    {processing ? (
                        <>
                            <Loader2 className="mr-2 h-4 w-4 animate-spin" />
                            Menyimpan...
                        </>
                    ) : (
                        'Simpan Pengguna'
                    )}
                </Button>
            </form>
        </div>
    );
}