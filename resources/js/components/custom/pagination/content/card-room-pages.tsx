import {
    PaginationComponentProps,
    Room
} from "@/types/index";
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle
} from '@/components/ui/card';

function RoomCardList({ paginator }: PaginationComponentProps<Room>) {
    return (
        <div className='@container/main'>
            <div className='*:data-[slot=card]:from-primary/5 *:data-[slot=card]:to-card dark:*:data-[slot=card]:bg-card grid grid-cols-1 gap-4 *:data-[slot=card]:bg-gradient-to-t *:data-[slot=card]:shadow-xs @xl/main:grid-cols-2 @7xl/main:grid-cols-4'>
                {paginator.data.map((room, index) => {
                    return (
                        <Card className='@container/card transition-transform duration-200 hover:-translate-y-2 hover:shadow-lg' key={index}>
                            <CardHeader>
                                <CardDescription>{room.name}</CardDescription>
                                <CardTitle className='text-2xl font-extrabold tabular-nums @[250px]/card:text-4xl @[250px]/card:font-extrabold'>{room.room_code}</CardTitle>
                            </CardHeader>
                            <CardContent>
                                <CardDescription className="line-clamp-5">
                                    {room.description}
                                </CardDescription>
                            </CardContent>
                            <CardFooter className="grid grid-cols-1 gap-2 @[300px]/card:grid-cols-2">
                                <CardDescription className="">
                                    Room Wide : {room.floor_wide_in_meter_squared} m<sup>2</sup>.
                                </CardDescription>
                                <CardDescription className="">
                                    Room Height : {room.height_in_meter} m.
                                </CardDescription>
                            </CardFooter>
                        </Card>
                    );
                })}
            </div>
        </div>
    )
}

export {
    RoomCardList
}