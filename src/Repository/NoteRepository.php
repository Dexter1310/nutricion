<?php

namespace App\Repository;

use App\Entity\Note;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Note>
 *
 * @method Note|null find($id, $lockMode = null, $lockVersion = null)
 * @method Note|null findOneBy(array $criteria, array $orderBy = null)
 * @method Note[]    findAll()
 * @method Note[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Note::class);
    }

    public function newNote(Note $note,User $user)
    {

        $state=$user !== $note->getUser()?1:0; //envio propio o a otro usuario en 0 o 1
        $note->setState($state);
        $this->getEntityManager()->persist($note);
        $this->getEntityManager()->flush();
    }

    public function getNotesList($user):array
    {

        return $this->createQueryBuilder('n')
            ->addSelect('n')
            ->andWhere('n.user= :user')
            ->setParameter('user',$user)
            ->orderBy('n.title', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function deleteNote($id)
    {
        $note=$this->find(['id'=>$id]);
        $this->getEntityManager()->remove($note);
        $this->getEntityManager()->flush();

        return "note delete";

    }

//    /**
//     * @return Note[] Returns an array of Note objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Note
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
