<?php

declare( strict_types = 1);

namespace App\Http\Payloads;

final class NewClient
{
    /**
     * @param string $name
     * @param string $email
     * @param string $company
     */
    public function __construct(
        private readonly string $name,
        public readonly string $email,
        public string $company,
    ) {}

    /**
     * @return array{name:string,email:string,company_id:string}
     */
    public function toArray() : array 
    {
        return [
            'name'  => $this->name,
            'email' => $this->email,
            'company_id' => $this->company,
        ]; 
    }

    public function company(string $company) : NewClient 
    {
        $this->company = $company;
        
        return $this;
    }

    /**
     * @param array{name:string,email:string,company:string} $data
     * @return NewClient
     */
    public static function fromArray(array $data) : NewClient 
    {
        return new NewClient(
            name: $data['name'],
            email: $data['email'],
            company: $data['company'],
        );
    }
}