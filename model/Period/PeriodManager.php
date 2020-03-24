<?php


class PeriodManager
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db =$db;
    }

    public function AddPeriod($period){
        $period = new Period($period);

        $req = $this->db->prepare('INSERT INTO PERIOD 
(MATCHID, PERIODNUM, HOMESCORE, AWAYSCORE, MISSSHOT, SHOTONTARGET, MISSPASS, SUCCESSPASS, FOUL, CORNERKICK, LOSTBALL, WINBALL, OFFSIDE, FREEKICK) VALUES 
(:matchid, :periodnum, :homescore, :awayscore, :missshot, :shotontarget, :misspass, :successpass, :foul, :cornerkick, :lostball, :winball, :offside, :freekick)');
        $req->bindValue(':matchid', $period->getMatchid());
        $req->bindValue(':periodnum', $period->getPeriodnum());
        $req->bindValue(':homescore', $period->getHomescore());
        $req->bindValue(':awayscore', $period->getAwayscore());
        $req->bindValue(':missshot', $period->getMissshot());
        $req->bindValue(':shotontarget', $period->getShotontarget());
        $req->bindValue(':misspass', $period->getMisspass());
        $req->bindValue(':successpass', $period->getSuccesspass());
        $req->bindValue(':foul', $period->getFoul());
        $req->bindValue(':cornerkick', $period->getCornerkick());
        $req->bindValue(':lostball', $period->getLostball());
        $req->bindValue(':winball', $period->getWinball());
        $req->bindValue(':offside', $period->getOffside());
        $req->bindValue(':freekick', $period->getFreekick());

        $req->execute();
    }


}