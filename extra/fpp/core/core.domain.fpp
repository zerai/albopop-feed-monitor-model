namespace Core\Domain\Monitor {

    data ItemId = ItemId deriving (Uuid);

    data AlboUrl = String deriving (FromString, ToString, Equals) where | strlen($value) < 5 => 'albopop url too short';
    data FeedUrl = String deriving (FromString, ToString, Equals) where | strlen($value) < 5 => 'feed url too short';




//   EXCEPTION
//    /*data ContestNotFound = ContestNotFound { ContestId $id } deriving (Exception);*/

}